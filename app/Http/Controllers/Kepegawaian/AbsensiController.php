<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\users_foto;
use App\Models\kepegawaian\absensi;
use App\Models\kepegawaian\jadwal;
use App\Models\kepegawaian\jadwal_detail;
use App\Models\kepegawaian\ref_jadwal_shift;
use App\Models\kepegawaian\ref_jadwal_users;
use App\Models\kepegawaian\ref_jadwal_jabatan;
use App\Models\model_has_roles;
use App\Models\struktur_organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth, DB;
use Validator,Redirect,Response,File,Storage;

class AbsensiController extends Controller
{
    function index()
    {
        if (
                Auth::user()->getPermission('admin_kepegawaian') == true ||
                Auth::user()->getRole('karu-it') == true
            ) {
            $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
            $jabatan = ref_jadwal_users::select('id','unit')->groupBy('id','unit')->get();

            $data = [
                'users' => $users,
                'jabatan' => $jabatan,
            ];

            return view('pages.kepegawaian.absensi.index')->with('list', $data);
        } else {
            return redirect()->back()->withErrors("Maaf, Anda tidak memiliki akses untuk membuka halaman Absensi Karyawan!");
        }
    }

    function tableMonitoring(Request $request)
    {
        // ============ UNIT ====================================================
        $unit_ids = json_decode($request->input('unit'), true); // [2, 11]
        // ============ DARI - SAMPAI ==========================================
        if ($request->dari != null && $request->sampai != null) {
            $dari = Carbon::parse($request->dari)->isoFormat('YYYY-MM-DD');
            $sampai = Carbon::parse($request->sampai)->isoFormat('YYYY-MM-DD');
        } else {
            $dari = Carbon::parse()->isoFormat('YYYY-MM-DD');
            $sampai = Carbon::parse()->isoFormat('YYYY-MM-DD');
        }
        // ============ JENIS ==================================================
        $jenis = $request->jenis;
        // =====================================================================
        $show = absensi::leftJoin('users', 'users.id', '=', 'kepegawaian_absensi.pegawai_id')
                        ->leftJoin('users_foto', 'users.id', '=', 'users_foto.user_id')
                        ->select('kepegawaian_absensi.*', 'users.nama as nama_pegawai', 'users_foto.filename as foto_user')
                        // Menambahkan kondisi untuk memeriksa apakah unit_ids tidak kosong
                        ->when(!empty($unit_ids), function ($query) use ($unit_ids) {
                            // Lakukan join hanya jika unit_ids ada
                            $query->join('referensi_jadwal_users', function ($join) {
                                // Pastikan nilai yang dibandingkan dalam JSON_CONTAINS adalah string
                                $join->on(DB::raw('JSON_CONTAINS(referensi_jadwal_users.staf, JSON_QUOTE(CAST(kepegawaian_absensi.pegawai_id AS CHAR)))'), '=', DB::raw('TRUE'))
                                    ->whereNull('referensi_jadwal_users.deleted_at'); // Menambahkan filter deleted_at IS NULL
                            })
                            ->whereIn('referensi_jadwal_users.id', $unit_ids);
                        })
                        ->when($jenis != 0, function ($query) use ($jenis) {
                            $query->where('kepegawaian_absensi.jenis', $jenis);
                        })
                        ->when($request->dari && $request->sampai, function ($query) use ($dari, $sampai) {
                            $start = $dari . ' 00:00:00';
                            $end = $sampai . ' 23:59:59';
                            $query->whereBetween('kepegawaian_absensi.tgl_in', [$start, $end]);
                        })
                        ->whereNull('kepegawaian_absensi.deleted_at')
                        ->orderBy('kepegawaian_absensi.tgl_in', 'desc')
                        ->get();
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->select('model_has_roles.model_id as id_user','roles.name as nama_role')->get();

        $data = [
            'show' => $show,
            'users' => $users,
            'role' => $role,
        ];

        return response()->json($data);
    }

    function tableAll(Request $request)
    {
        // ============ UNIT ====================================================
        $unit_ids = json_decode($request->input('unit'), true); // [2, 11]
        // ============ DARI - SAMPAI ==========================================
        if ($request->dari != null && $request->sampai != null) {
            $dari = Carbon::parse($request->dari)->isoFormat('YYYY-MM-DD');
            $sampai = Carbon::parse($request->sampai)->isoFormat('YYYY-MM-DD');
        } else {
            $dari = Carbon::parse()->isoFormat('YYYY-MM-DD');
            $sampai = Carbon::parse()->isoFormat('YYYY-MM-DD');
        }
        // ============ JENIS ==================================================
        $jenis = $request->jenis;
        // =====================================================================
        $show = absensi::leftJoin('users', 'users.id', '=', 'kepegawaian_absensi.pegawai_id')
                        ->leftJoin('users_foto', 'users.id', '=', 'users_foto.user_id')
                        ->select('kepegawaian_absensi.*', 'users.id as id_pegawai','users.nama as nama_pegawai','users.nip as nip_pegawai', 'users_foto.filename as foto_user')
                        // Menambahkan kondisi untuk memeriksa apakah unit_ids tidak kosong
                        ->when(!empty($unit_ids), function ($query) use ($unit_ids) {
                            // Lakukan join hanya jika unit_ids ada
                            $query->join('referensi_jadwal_users', function ($join) {
                                // Pastikan nilai yang dibandingkan dalam JSON_CONTAINS adalah string
                                $join->on(DB::raw('JSON_CONTAINS(referensi_jadwal_users.staf, JSON_QUOTE(CAST(kepegawaian_absensi.pegawai_id AS CHAR)))'), '=', DB::raw('TRUE'))
                                    ->whereNull('referensi_jadwal_users.deleted_at'); // Menambahkan filter deleted_at IS NULL
                            })
                            ->whereIn('referensi_jadwal_users.id', $unit_ids);
                        })
                        ->when($jenis != 0, function ($query) use ($jenis) {
                            $query->where('kepegawaian_absensi.jenis', $jenis);
                        })
                        ->when($request->dari && $request->sampai, function ($query) use ($dari, $sampai) {
                            $start = $dari . ' 00:00:00';
                            $end = $sampai . ' 23:59:59';
                            $query->whereBetween('kepegawaian_absensi.tgl_in', [$start, $end]);
                        })
                        ->whereNull('kepegawaian_absensi.deleted_at')
                        ->orderBy('kepegawaian_absensi.tgl_in', 'desc')
                        ->orderBy('users.nama', 'desc')
                        ->get();
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->select('model_has_roles.model_id as id_user','roles.name as nama_role')->get();

        $data = [
            'show' => $show,
            'users' => $users,
            'role' => $role,
        ];

        return response()->json($data);
    }

    function tableRekapAbsensi(Request $request) // REQUEST LINDA
    {
        // Ambil input dan parsing tanggal
        $unit_ids = json_decode($request->input('unit'), true);
        $jenis = $request->jenis;

        $dari = $request->dari ? Carbon::parse($request->dari)->format('Y-m-d') : now()->format('Y-m-d');
        $sampai = $request->sampai ? Carbon::parse($request->sampai)->format('Y-m-d') : now()->format('Y-m-d');

        // Query utama absensi
        $query = DB::table('kepegawaian_absensi as a')
            ->join('users as u', 'u.id', '=', 'a.pegawai_id')
            ->select(
                'a.pegawai_id',
                'u.nama',
                'u.nip',
                DB::raw("COUNT(*) as total_absensi"),
                DB::raw("SUM(CASE WHEN a.jenis = 3 THEN 1 ELSE 0 END) as total_ijin"),
                DB::raw("SUM(CASE WHEN a.jenis = 1 AND a.tgl_out IS NULL THEN 1 ELSE 0 END) as total_alpha"),
                DB::raw("SUM(CASE WHEN a.jenis = 1 AND a.tgl_out IS NOT NULL AND a.terlambat = 1 THEN 1 ELSE 0 END) as total_terlambat"),
                DB::raw("SUM(CASE WHEN a.jenis = 1 AND a.tgl_out IS NOT NULL AND a.terlambat = 0 THEN 1 ELSE 0 END) as total_tidak_terlambat")
            )
            ->when(!empty($unit_ids), function ($query) use ($unit_ids) {
                $query->join('referensi_jadwal_users as rju', function ($join) {
                    $join->on(DB::raw('JSON_CONTAINS(rju.staf, JSON_QUOTE(CAST(a.pegawai_id AS CHAR)))'), '=', DB::raw('TRUE'))
                        ->whereNull('rju.deleted_at');
                })->whereIn('rju.id', $unit_ids);
            })
            ->when($jenis != 0, fn($query) => $query->where('a.jenis', $jenis))
            ->whereBetween('a.tgl_in', ["$dari 00:00:00", "$sampai 23:59:59"])
            ->groupBy('a.pegawai_id', 'u.nama', 'u.nip');

        $show = $query->get();

        // Iterasi tiap pegawai
        foreach ($show as $item) {
            // Ambil detail absensi untuk analisa status
            $absensiDetail = DB::table('kepegawaian_absensi as a')
                ->where('a.pegawai_id', $item->pegawai_id)
                ->when($jenis != 0, fn($q) => $q->where('a.jenis', $jenis))
                ->whereBetween('a.tgl_in', ["$dari 00:00:00", "$sampai 23:59:59"])
                ->orderBy('a.tgl_in')
                ->get(['a.tgl_in', 'a.terlambat', 'a.tgl_out']);

            $absenArray = $absensiDetail->map(fn($d) => [
                'tgl_in' => $d->tgl_in,
                'terlambat' => $d->terlambat,
                'alpha' => $d->tgl_out === null ? 1 : 0,
            ])->values();

            // Status: hangus beruntun, tidak beruntun, disiplin
            $hangus_beruntun = false;
            for ($i = 0; $i <= count($absenArray) - 5; $i++) {
                $chunk = array_slice($absenArray->toArray(), $i, 5);
                $jumlahTerlambat = collect($chunk)->where('terlambat', 1)->count();
                if ($jumlahTerlambat >= 4) {
                    $hangus_beruntun = true;
                    break;
                }
            }

            // Ambil unit
            $item->unit = DB::table('referensi_jadwal_users')
                ->whereNull('deleted_at')
                ->whereRaw('JSON_CONTAINS(staf, JSON_QUOTE(?))', [(string) $item->pegawai_id])
                ->value('unit') ?? '-';

            // Pegawai induk
            $pegawaiInduk = DB::table('referensi_jadwal_users')
                ->whereNull('deleted_at')
                ->whereRaw('JSON_CONTAINS(staf, JSON_QUOTE(?))', [(string) $item->pegawai_id])
                ->value('pegawai_id');

            // Ambil peta shift
            $shiftMap = DB::table('referensi_jadwal_shift')
                ->where('pegawai_id', $pegawaiInduk)
                ->pluck('shift', 'singkat')
                ->toArray();

            if ($item->pegawai_id == 267) {
                logger()->info("SHIFT MAP PEGAWAI INDUK 6", $shiftMap);
            }

            // Ambil rentang bulan
            $bulanTahun = collect(Carbon::parse($dari)->startOfMonth()->monthsUntil(Carbon::parse($sampai)->startOfMonth()->addMonth()))
                ->map(fn($d) => [$d->format('m'), $d->format('Y')])
                ->unique()
                ->values();

            $jadwalPerTanggal = [];

            // Tambahan counter shift khusus
            $shiftCounts = [
                'L'  => 0,  // Libur
                'C'  => 0,  // Cuti Tahunan
                'CM' => 0,  // Cuti Melahirkan
                'CU' => 0,  // Cuti Umroh
                'CH' => 0,  // Cuti Haji
                'CD' => 0,  // Cuti di Luar Tanggungan
            ];

            foreach ($bulanTahun as [$bulan, $tahun]) {
                $jadwal = DB::table('kepegawaian_jadwal as kj')
                    ->join('kepegawaian_jadwal_detail as kd', 'kd.id_jadwal', '=', 'kj.id')
                    ->where('kd.pegawai_id', $item->pegawai_id)
                    ->where('kj.bulan', $bulan)
                    ->where('kj.tahun', $tahun)
                    ->first();

                if (!$jadwal) continue;

                // Tentukan batas tanggal
                $startTgl = (int) (($bulan == Carbon::parse($dari)->format('m') && $tahun == Carbon::parse($dari)->format('Y')) ? Carbon::parse($dari)->format('d') : 1);
                $endTgl = (int) (($bulan == Carbon::parse($sampai)->format('m') && $tahun == Carbon::parse($sampai)->format('Y')) ? Carbon::parse($sampai)->format('d') : 31);

                for ($i = $startTgl; $i <= $endTgl; $i++) {
                    if (!checkdate($bulan, $i, $tahun)) continue;

                    $tgl = sprintf('%04d-%02d-%02d', $tahun, $bulan, $i);
                    if ($tgl < $dari || $tgl > $sampai) continue;

                    $key = 'tgl' . $i;
                    $kodeShift = $jadwal->$key ?? null;

                    if ($kodeShift) {
                        // Hitung shift khusus
                        if (array_key_exists($kodeShift, $shiftCounts)) {
                            $shiftCounts[$kodeShift]++;
                        }

                        // Hitung shift reguler
                        $dihitung = !in_array($kodeShift, ['L', 'C', 'CM', 'CU', 'CH', 'CD']) && array_key_exists($kodeShift, $shiftMap);
                        if ($dihitung) {
                            $jadwalPerTanggal[$tgl] = $kodeShift;
                        }

                        // if ($item->pegawai_id == 267) {
                        //     logger()->info("JADWAL HARIAN", [
                        //         'tanggal' => $tgl,
                        //         'shift' => $kodeShift,
                        //         'dihitung' => $dihitung,
                        //     ]);
                        // }
                    }
                }
            }

            $item->total_masuk_shift = count($jadwalPerTanggal);
            $item->total_L  = $shiftCounts['L'];
            $item->total_C  = $shiftCounts['C'];
            $item->total_CM = $shiftCounts['CM'];
            $item->total_CU = $shiftCounts['CU'];
            $item->total_CH = $shiftCounts['CH'];
            $item->total_CD = $shiftCounts['CD'];

            $totalMasukShift  = (int) $item->total_masuk_shift;
            $totalAbsensi     = (int) $item->total_absensi;
            $totalTerlambat   = (int) $item->total_terlambat;
            $totalAlpha       = (int) $item->total_alpha;
            $totalHilang      = $totalMasukShift - $totalAbsensi;
            $totalPelanggaran = $totalHilang + $totalTerlambat;

            $item->status = match (true) {
                $hangus_beruntun => 'hangus beruntun',
                ($totalAbsensi === $totalMasukShift && $totalTerlambat === 0 && $totalAlpha === 0) => 'disiplin',
                ($totalPelanggaran > 10) => 'hangus tidak beruntun',
                default => 'disiplin',
            };
        }

        $data = [
            'show' => $show,
        ];

        return response()->json($data);
    }

    function tableRekapAbsensiDetail(Request $request)
    {
        $unit_ids = json_decode($request->input('unit'), true);
        $jenis = $request->jenis;

        $dari = $request->dari ? Carbon::parse($request->dari)->format('Y-m-d') : now()->format('Y-m-d');
        $sampai = $request->sampai ? Carbon::parse($request->sampai)->format('Y-m-d') : now()->format('Y-m-d');

        $query = DB::table('kepegawaian_absensi as a')
            ->join('users as u', 'u.id', '=', 'a.pegawai_id')
            ->leftJoin('referensi_jadwal_users as rju', function ($join) {
                $join->on(DB::raw('JSON_CONTAINS(rju.staf, JSON_QUOTE(CAST(a.pegawai_id AS CHAR)))'), '=', DB::raw('TRUE'))
                    ->whereNull('rju.deleted_at');
            })
            ->select(
                'a.pegawai_id',
                'u.nama',
                'u.nip',
                'rju.unit',
                DB::raw("DATE(a.tgl_in) as tanggal"),
                DB::raw("TIME(a.tgl_in) as jam_masuk"),
                DB::raw("IF(a.tgl_out IS NOT NULL, TIME(a.tgl_out), NULL) as jam_pulang"),
                DB::raw("IF(a.jenis = 1, IF(a.tgl_out IS NULL, 'Absen 1x', IF(a.terlambat = 1, 'Terlambat', 'Tepat Waktu')), 'Toleransi') as status_keterangan"),
                DB::raw("IF(a.jenis = 3, 1, 0) as is_ijin"),
                DB::raw("IF(a.jenis = 1, IF(a.tgl_out IS NULL, 1, 0), 0) as is_alpha"),
                DB::raw("IF(a.jenis = 1, IF(a.tgl_out IS NOT NULL AND a.terlambat = 1, 1, 0), 0) as is_terlambat"),
                DB::raw("IF(a.jenis = 1, IF(a.tgl_out IS NOT NULL AND a.terlambat = 0, 1, 0), 0) as is_tidak_terlambat")
            )
            ->when(!empty($unit_ids), function ($query) use ($unit_ids) {
                $query->whereIn('rju.id', $unit_ids);
            })
            ->when($jenis != 0, function ($query) use ($jenis) {
                $query->where('a.jenis', $jenis);
            })
            ->whereBetween('a.tgl_in', [$dari . ' 00:00:00', $sampai . ' 23:59:59'])
            ->orderBy('a.pegawai_id')
            ->orderBy('a.tgl_in');

        $show = $query->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data);
    }

    function detail($id)
    {
        $show = absensi::where('id',$id)->first();

        $data = [
            'show' => $show,
        ];

        return response()->json($data);
    }
}
