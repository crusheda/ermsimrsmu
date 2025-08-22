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
                Auth::user()->getPermission('admin_kepegawaian_kepala') == true
            ) {
            $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
            $jabatan = ref_jadwal_users::select('id','unit')->groupBy('id','unit')->orderBy('unit','asc')->get();

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

        // Ambil semua pegawai yang termasuk staf dari referensi_jadwal_users
        $show = DB::table('referensi_jadwal_users as rju')
            ->select(
                'u.id as pegawai_id',
                'u.nama',
                'u.nip',
                'rju.unit',
                DB::raw('IFNULL((
                    SELECT COUNT(*) FROM kepegawaian_absensi as a
                    WHERE a.pegawai_id = u.id
                    AND a.deleted_at IS NULL
                    AND a.tgl_in BETWEEN "' . $dari . ' 00:00:00" AND "' . $sampai . ' 23:59:59"
                    ' . ($jenis != 0 ? 'AND a.jenis = ' . (int) $jenis : '') . '
                ), 0) as total_absensi'),
                DB::raw('IFNULL((
                    SELECT COUNT(*) FROM kepegawaian_absensi as a
                    WHERE a.pegawai_id = u.id AND a.jenis = 3
                    AND a.deleted_at IS NULL
                    AND a.tgl_in BETWEEN "' . $dari . ' 00:00:00" AND "' . $sampai . ' 23:59:59"
                ), 0) as total_ijin'),
                DB::raw('IFNULL((
                    SELECT COUNT(*) FROM kepegawaian_absensi as a
                    WHERE a.pegawai_id = u.id AND a.jenis = 1 AND a.tgl_out IS NULL
                    AND a.deleted_at IS NULL
                    AND a.tgl_in BETWEEN "' . $dari . ' 00:00:00" AND "' . $sampai . ' 23:59:59"
                ), 0) as total_alpha'),
                DB::raw('IFNULL((
                    SELECT COUNT(*) FROM kepegawaian_absensi as a
                    WHERE a.pegawai_id = u.id AND a.jenis = 1 AND a.tgl_out IS NOT NULL AND a.terlambat = 1
                    AND a.deleted_at IS NULL
                    AND a.tgl_in BETWEEN "' . $dari . ' 00:00:00" AND "' . $sampai . ' 23:59:59"
                ), 0) as total_terlambat'),
                DB::raw('IFNULL((
                    SELECT COUNT(*) FROM kepegawaian_absensi as a
                    WHERE a.pegawai_id = u.id AND a.jenis = 1 AND a.tgl_out IS NOT NULL AND a.terlambat = 0
                    AND a.deleted_at IS NULL
                    AND a.tgl_in BETWEEN "' . $dari . ' 00:00:00" AND "' . $sampai . ' 23:59:59"
                ), 0) as total_tidak_terlambat')
            )
            ->join('users as u', function ($join) {
                $join->on(DB::raw('JSON_CONTAINS(rju.staf, JSON_QUOTE(CAST(u.id AS CHAR)))'), '=', DB::raw('TRUE'));
            })
            ->whereNull('rju.deleted_at')
            ->when(!empty($unit_ids), fn($q) => $q->whereIn('rju.id', $unit_ids))
            // ->where('rju.pegawai_id',232)
            ->groupBy('u.id', 'u.nama', 'u.nip', 'rju.unit')
            ->get();

        // Iterasi tiap pegawai
        foreach ($show as $item) {
            // Ambil detail absensi untuk analisa status
            $absensiDetail = DB::table('kepegawaian_absensi as a')
                ->where('a.pegawai_id', $item->pegawai_id)
                ->when($jenis != 0, fn($q) => $q->where('a.jenis', $jenis))
                ->whereBetween('a.tgl_in', ["$dari 00:00:00", "$sampai 23:59:59"])
                ->whereNull('a.deleted_at')
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
                ->whereNull('deleted_at')
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
                    ->join('kepegawaian_jadwal_detail as kd', function($join) {
                        $join->on('kd.id_jadwal', '=', 'kj.id')
                            ->whereNull('kd.deleted_at');
                    })
                    ->where('kd.pegawai_id', $item->pegawai_id)
                    ->where('kj.bulan', $bulan)
                    ->where('kj.tahun', $tahun)
                    ->where('kj.progress', '!=', 0)
                    ->whereNull('kj.deleted_at')
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
            ->whereNull('a.deleted_at')
            ->orderBy('a.pegawai_id')
            ->orderBy('a.tgl_in');

        $show = $query->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data);
    }

    public function getCutiPegawai(Request $request)
    {
        $dari = Carbon::parse($request->dari ?? now());
        $sampai = Carbon::parse($request->sampai ?? now());

        $data = [];

        // Ambil semua bulan-tahun dalam range filter
        $bulanTahun = collect($dari->copy()->startOfMonth()->monthsUntil($sampai->copy()->startOfMonth()))
            ->map(fn($d) => [$d->format('m'), $d->format('Y')])
            ->unique()
            ->values();

        foreach ($bulanTahun as [$bulan, $tahun]) {
            $jadwal = DB::table('kepegawaian_jadwal as kj')
                ->join('kepegawaian_jadwal_detail as kd', function ($join) {
                    $join->on('kd.id_jadwal', '=', 'kj.id')->whereNull('kd.deleted_at');
                })
                ->join('users as u', 'u.id', '=', 'kd.pegawai_id')
                ->join('referensi_jadwal_users as rju', DB::raw('JSON_CONTAINS(rju.staf, JSON_QUOTE(CAST(kd.pegawai_id AS CHAR)))'), '=', DB::raw('TRUE'))
                ->where('kj.bulan', $bulan)
                ->where('kj.tahun', $tahun)
                ->where('kj.progress', '!=', 0)
                ->whereNull('kj.deleted_at')
                ->select('kd.*', 'u.nip', 'u.nama', 'rju.unit')
                ->get();

            foreach ($jadwal as $row) {
                // Tentukan rentang tanggal yang akan dicek untuk bulan ini
                $startTgl = ((int)$bulan === (int)$dari->format('m') && (int)$tahun === (int)$dari->format('Y'))
                            ? (int) $dari->format('d')
                            : 1;
                $endTgl = ((int)$bulan === (int)$sampai->format('m') && (int)$tahun === (int)$sampai->format('Y'))
                            ? (int) $sampai->format('d')
                            : cal_days_in_month(CAL_GREGORIAN, (int)$bulan, (int)$tahun);

                for ($i = $startTgl; $i <= $endTgl; $i++) {
                    if (!checkdate((int)$bulan, $i, (int)$tahun)) continue;

                    $kode = $row->{'tgl'.$i} ?? null;
                    if (!$kode) continue;

                    $jenisCuti = match($kode) {
                        'C'  => 'Cuti Tahunan',
                        'CM' => 'Cuti Melahirkan',
                        'CU' => 'Cuti Umroh',
                        'CH' => 'Cuti Haji',
                        'CD' => 'Cuti di Luar Tanggungan',
                        default => null
                    };

                    if ($jenisCuti) {
                        $tanggal = Carbon::createFromDate($tahun, $bulan, $i);
                        $data[] = [
                            'nip' => $row->nip,
                            'nama' => $row->nama,
                            'unit' => $row->unit,
                            'tanggal_cuti' => $tanggal->translatedFormat('d F Y'),
                            'jenis_cuti' => $jenisCuti
                        ];
                    }
                }
            }
        }

        return response()->json($data);
    }

    function getMonitoringAbsensiHarian(Request $request)
    {
        $tanggal = Carbon::parse($request->tanggal ?? now())->format('Y-m-d');
        $tglHari = (int)Carbon::parse($tanggal)->format('d');
        $bulan   = Carbon::parse($tanggal)->format('m');
        $tahun   = Carbon::parse($tanggal)->format('Y');
        $unitIds = json_decode($request->input('unit'), true) ?? [];

        $data = [];

        // Ambil semua referensi_jadwal_users (unit dan staf)
        $rjuList = DB::table('referensi_jadwal_users')
            ->whereNull('deleted_at')
            ->when(!empty($unitIds), fn($q) => $q->whereIn('id', $unitIds))
            ->get();

        // Mapping: pegawai_id -> unit & pegawai_induk
        $pegawaiUnitMap = collect();
        $pegawaiIndukMap = collect();
        foreach ($rjuList as $rju) {
            $stafList = json_decode($rju->staf ?? '[]', true);
            foreach ($stafList as $id) {
                $pegawaiUnitMap[$id] = $rju->unit;
                $pegawaiIndukMap[$id] = $rju->pegawai_id;
            }
        }

        // Ambil semua pegawai yang dijadwalkan di tanggal tersebut
        $jadwalList = DB::table('kepegawaian_jadwal as kj')
            ->join('kepegawaian_jadwal_detail as kd', function ($join) {
                $join->on('kd.id_jadwal', '=', 'kj.id')->whereNull('kd.deleted_at');
            })
            ->join('users as u', 'u.id', '=', 'kd.pegawai_id')
            ->where('kj.bulan', $bulan)
            ->where('kj.tahun', $tahun)
            ->where('kj.progress', '!=', 0)
            ->whereNull('kj.deleted_at')
            ->select('kd.*', 'u.nip', 'u.nama')
            ->get();

        foreach ($jadwalList as $row) {
            if (!isset($pegawaiUnitMap[$row->pegawai_id])) continue;

            $kodeShift = $row->{'tgl'.$tglHari} ?? null;
            if (!$kodeShift) continue;

            $unit = $pegawaiUnitMap[$row->pegawai_id] ?? null;
            $pegawaiInduk = $pegawaiIndukMap[$row->pegawai_id] ?? null;

            $statusDisiplin = '-';
            $statusAbsensi = 'Belum Absen / Alpha';
            $jamBerangkat = '00:00:00';
            $jamPulang = '00:00:00';
            $absenBerangkat = '-';
            $absenPulang = '-';

            // Ambil absensi
            $absen = DB::table('kepegawaian_absensi')
                ->where('pegawai_id', $row->pegawai_id)
                ->whereDate('tgl_in', $tanggal)
                ->whereNull('deleted_at')
                ->orderBy('tgl_in')
                ->first();

            // Ambil shift info
            $shift = null;
            if (!in_array($kodeShift, ['C', 'CM', 'CU', 'CH', 'CD', 'L']) && $pegawaiInduk) {
                $shift = DB::table('referensi_jadwal_shift')
                    ->where('pegawai_id', $pegawaiInduk)
                    ->where('singkat', $kodeShift)
                    ->whereNull('deleted_at')
                    ->first();

                $jamBerangkat = $shift->berangkat ?? '00:00:00';
                $jamPulang = $shift->pulang ?? '00:00:00';
            }

            $labelCuti = match($kodeShift) {
                'C'  => 'Cuti Tahunan',
                'CM' => 'Cuti Melahirkan',
                'CU' => 'Cuti Umroh',
                'CH' => 'Cuti Haji',
                'CD' => 'Cuti di Luar Tanggungan',
                'L'  => 'Libur',
                default => null
            };

            // Status Shift dan Disiplin
            if ($absen && $absen->jenis == 3) {
                $statusDisiplin = 'Toleransi';
                $statusShift = $labelCuti
                    ? $labelCuti . ' (Izin)'
                    : ($shift ? 'Masuk Shift ' . $shift->shift . ' (Izin)' : 'Masuk Shift ' . $kodeShift . ' (Izin)');
                $statusAbsensi = '-'; // Izin dianggap pengecualian
            } elseif ($labelCuti) {
                $statusShift = $labelCuti;
                $statusDisiplin = '-';
                $statusAbsensi = '-';
            } else {
                $statusShift = $shift
                    ? 'Masuk Shift ' . $shift->shift
                    : 'Masuk Shift ' . $kodeShift;

                if ($absen) {
                    $jamMasuk = Carbon::parse($absen->tgl_in)->format('H:i:s');
                    $absenBerangkat = $jamMasuk;

                    if (!is_null($absen->tgl_out)) {
                        $absenPulang = Carbon::parse($absen->tgl_out)->format('H:i:s');
                        $statusAbsensi = 'Lengkap';
                    } elseif ($absen->jenis == 1) {
                        $statusAbsensi = 'Absen 1x / Tidak Lengkap';
                    }

                    $toleransiJamBerangkat = Carbon::parse($shift->berangkat)->addMinutes(10)->format('H:i:s');
                    $statusDisiplin = ($jamBerangkat && $jamMasuk > $toleransiJamBerangkat)
                        ? 'Terlambat'
                        : 'Tepat Waktu';
                }
            }

            $data[] = [
                'nip' => $row->nip,
                'nama' => $row->nama,
                'unit' => $unit,
                'status_shift' => $statusShift ?? '-',
                'status_disiplin' => $statusDisiplin,
                'status_absensi' => $statusAbsensi,
                'jam_berangkat' => $jamBerangkat,
                'jam_pulang' => $jamPulang,
                'absen_berangkat' => $absenBerangkat,
                'absen_pulang' => $absenPulang,
            ];
        }

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
