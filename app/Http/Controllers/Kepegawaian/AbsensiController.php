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
        $show = absensi::join('users', 'users.id', '=', 'kepegawaian_absensi.pegawai_id')
                        ->join('users_foto', 'users.id', '=', 'users_foto.user_id')
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
        $show = absensi::join('users', 'users.id', '=', 'kepegawaian_absensi.pegawai_id')
                        ->join('users_foto', 'users.id', '=', 'users_foto.user_id')
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

    function show($id)
    {

    }
}
