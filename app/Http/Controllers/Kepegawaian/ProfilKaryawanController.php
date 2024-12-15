<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\users_foto;
use App\Models\users_doc;
use App\Models\users_rotasi;
use App\Models\users_status;
use App\Models\users_spkrkk;
use App\Models\logs;
use App\Models\alamat;
use App\Models\model_has_roles;
use App\Models\roles;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class ProfilKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show  = users::where('nik','!=',null)->orderBy('nama', 'asc')->get();
        $showMin  = users::where('nik',null)->count();

        $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name as nama_role', 'users.id as id_user')
            ->get();

        $data = [
            'show' => $show,
            'showmin' => $showMin,
            'role' => $role,
        ];

        return view('pages.profilkaryawan.index')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // TAMPILAN HALAMAN DETAIL PROFIL KEPEGAWAIAN
    {
        $show = DB::table('users')
                ->where('users.id','=', $id)
                ->first();
        $users = users::where('nik','!=',null)->where('nik','!=',0)->orderBy('nama', 'asc')->get();
        $foto = DB::table('users_foto')->where('user_id', '=', $id)->first();
        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->select('model_has_roles.model_id as id_user','roles.name as nama_role')->get();
        $onlyRole = roles::get();
        $provinsi = alamat::select('provinsi')->groupBy('provinsi')->get();
        $kota = alamat::select('nama_kabkota')->groupBy('nama_kabkota')->get();
        $model = model_has_roles::where('model_id', $id)->get();

        // GET DATA OF USER
        $users_status = users_status::join('referensi','referensi.id','=','users_status.ref_id')
                    ->select('users_status.*','referensi.deskripsi as nama_referensi')
                    ->where('users_status.pegawai_id',$id)
                    ->where('users_status.status',1)
                    ->orderBy('users_status.updated_at','desc')
                    ->first();
        // print_r($users_status);
        // die();
        // REFERENSI
        $ref_dokumen = referensi::where('ref_jenis',8)->orderBy('queue','ASC')->get(); // 8 is Jenis Dokumen User
        $ref_rotasi = referensi::where('ref_jenis',9)->orderBy('queue','ASC')->get(); // 10 is Jenis Rotasi Pegawai
        $ref_penetapan = referensi::where('ref_jenis',10)->orderBy('queue','ASC')->get(); // 10 is Jenis Penetapan Pegawai

        $data = [
            'id_user' => $id,
            'showlog' => $showlog,
            'model' => $model,
            'show' => $show,
            'users' => $users,
            'foto' => $foto,
            'role' => $role,
            'onlyRole' => $onlyRole,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'users_status' => $users_status,
            'ref_dokumen' => $ref_dokumen,
            'ref_rotasi' => $ref_rotasi,
            'ref_penetapan' => $ref_penetapan,
        ];

        return view('pages.profilkaryawan.detail')->with('list', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = users::find($id);
        $data->delete();

        return Redirect::back()->with('message','Anda berhasil menonaktifkan Karyawan pada '.$tgl);
    }

    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = users::find($id);
        $data->delete();

        return Redirect::back()->with('message','Anda berhasil menonaktifkan Karyawan pada '.$tgl);
    }

    // API
    function table()
    {
        $show = users::where('status',null)->orderBy('updated_at','desc')->get();

        $data = [
            'show' => $show
        ];

        return response()->json($data, 200);
    }

    function tableAll()
    {
        $show = users::leftJoin('users_status as us','users.id','=','us.pegawai_id')
                ->leftJoin('referensi as rf','rf.id','=','us.ref_id')
                ->leftJoin('referensi as rp','rp.id','=','users.ref_profesi')
                ->where('us.deleted_at',null)
                ->where('users.status',null)
                ->select('users.*','rf.deskripsi as profesi','rp.deskripsi as klasifikasi_user')
                ->orderBy('users.nip','asc')
                ->get();
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('model_has_roles.model_id as id_user','roles.name as nama_role')
                ->get();

        $data = [
            'show' => $show,
            'role' => $role,
        ];

        return response()->json($data, 200);
    }

    function tableNonaktif()
    {
        $show = users::onlyTrashed()->orderBy('deleted_at','desc')->get();

        $data = [
            'show' => $show
        ];

        return response()->json($data, 200);
    }

    function tableNonLengkap()
    {
        $show = users::where('nik', null)->orderBy('updated_at','desc')->get();

        $data = [
            'show' => $show
        ];

        return response()->json($data, 200);
    }

    function setAktif($user,$id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // $data = DB::table('users')->where('id',$id)->first();
        $data = users::onlyTrashed()->where('id',$id)->first();
        $data->user_hapus = null;
        $data->deleted_at = null;
        $data->save();

        // CEK DATA & SAVE LOG
        datalogs::record($user, 'Baru saja mengaktifkan status Login Pegawai ID : '.$id, null, null, null, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return response()->json($tgl, 200);
    }

    function setNonAktif($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = users::find($id);
        $data->delete();

        return response()->json($tgl, 200);
    }

    function hapusPegawai($user,$id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // print_r($id);
        // die();
        // Inisialisasi
        $data = users::find($id);
        $switch = $data;

        // Proses Hapus Data dari DB
        $data->user_hapus = $user;
        $data->save();
        $data->delete();

        // CEK DATA & SAVE LOG
        datalogs::record($user, 'Baru saja menghapus/menonaktifkan Pegawai ID : '.$id, null, null, $switch, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return response()->json($tgl, 200);
    }
}
