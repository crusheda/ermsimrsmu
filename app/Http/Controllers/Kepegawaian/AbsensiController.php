<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\users_foto;
use App\Models\kepegawaian\jadwal;
use App\Models\kepegawaian\jadwal_detail;
use App\Models\kepegawaian\ref_jadwal_shift;
use App\Models\kepegawaian\ref_jadwal_users;
use App\Models\kepegawaian\ref_jadwal_jabatan;
use App\Models\kepegawaian\absensi\absensi;
use App\Models\struktur_organisasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
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

    function table()
    {
        $show = absensi::join('users','users.id','=','kepegawaian_absensi.pegawai_id')
                        ->leftJoin('users_foto','users_foto.user_id','=','kepegawaian_absensi.pegawai_id')
                        ->select('kepegawaian_absensi.*','users.nama as nama_pegawai','users_foto.title as title_foto_profil','users_foto.filename as filename_foto_profil')
                        ->where('users_foto.deleted_at',null)
                        ->orderBy('kepegawaian_absensi.tgl_in','desc')
                        ->get();
        // $foto_user = users_foto::get();
        // $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();

        $data = [
            'show' => $show,
            // 'users' => $users,
            // 'foto_user' => $foto_user,
        ];

        return response()->json($data);
    }

    function show($id)
    {

    }
}
