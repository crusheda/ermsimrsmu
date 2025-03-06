<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\users_foto;
use App\Models\kepegawaian\absensi\absensi;
use App\Models\kepegawaian\absensi\jadwal;
use App\Models\kepegawaian\absensi\jadwal_detail;
use App\Models\kepegawaian\absensi\ref_staf;
use App\Models\kepegawaian\absensi\ref_jaga;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File;

class AbsensiController extends Controller
{
    function index()
    {
        if (
                Auth::user()->getPermission('admin_kepegawaian') == true ||
                Auth::user()->getRole('karu-it') == true
            ) {
            $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();

            $data = [
                'users' => $users,
            ];

            return view('pages.kepegawaian.absensi.index')->with('list', $data);
        } else {
            return redirect()->back()->withErrors("Maaf, Anda tidak memiliki akses untuk membuka halaman Absensi Karyawan!");
        }
    }

    function table()
    {
        $show = absensi::join('users','users.id','=','kepegawaian_absensi.pegawai_id')
                        ->select('kepegawaian_absensi.*','users.nama as nama_pegawai')
                        ->orderBy('kepegawaian_absensi.tgl_in','desc')
                        ->get();
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();

        $data = [
            'show' => $show,
            'users' => $users,
        ];

        return response()->json($data);
    }

    function show($id)
    {

    }
}
