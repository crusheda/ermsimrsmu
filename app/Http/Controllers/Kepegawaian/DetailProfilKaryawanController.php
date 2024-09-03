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
use App\Models\users_status;
use App\Models\users_rotasi;
use App\Models\logs;
use App\Models\alamat;
use App\Models\model_has_roles;
use App\Models\roles;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class DetailProfilKaryawanController extends Controller
{
    // FUNCTION TABLE
    function table() // Table PROFIL KARYAWAN JS
    {
        $show = users::where('status',null)->orderBy('updated_at','desc')->get();

        $data = [
            'show' => $show
        ];

        return response()->json($data, 200);
    }

    function tablePenetapan($id)
    {
        $show = users_status::withTrashed()
                ->join('referensi','referensi.id','=','users_status.ref_id')
                ->join('users','users.id','=','users_status.user_id')
                ->select('users.nama as nama_kepegawaian','referensi.deskripsi as nama_referensi','users_status.*')
                ->where('users_status.pegawai_id',$id)
                ->orderBy('users_status.updated_at','desc')
                ->get();

        $data = [
            'show' => $show
        ];

        return response()->json($data, 200);
    }

    function tableRotasi($id)
    {
        $show = users_rotasi::withTrashed()
                ->join('referensi','referensi.id','=','users_rotasi.ref_id')
                ->join('users','users.id','=','users_rotasi.user_id')
                ->select('users.nama as nama_kepegawaian','referensi.deskripsi as nama_referensi','users_rotasi.*')
                ->where('users_rotasi.pegawai_id',$id)
                ->orderBy('users_rotasi.updated_at','desc')
                ->get();
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('model_has_roles.role_id as id_role','roles.name as nama_role','roles.deskripsi as deskripsi_role')
                ->where('model_has_roles.model_id',$id)
                ->get();
        $onlyRole = roles::select('id as id_role','name as nama_role','deskripsi as deskripsi_role')->get();

        $data = [
            'show' => $show,
            'role' => $role,
            'onlyRole' => $onlyRole,
        ];

        return response()->json($data, 200);
    }

    // FUNCTION TAMBAH
    function tambahPenetapan(Request $request)
    {
        $now = Carbon::now();
        $tgl = $now->isoFormat('dddd, D MMMM Y, HH:mm a');
        $tgl_berlaku = $now->isoFormat('YYYY-MM-DD');

        // VALIDASI DATA
        $validasi = users_status::where('pegawai_id',$request->pegawai_id)->orderBy('created_at','desc')->first();
        if (!empty($validasi) || $validasi != '') {
            $validasi->status = 0;
            $validasi->save();
            // $validasi->update([
            //     'status'     => false,
            // ]);
        }

        // SAVING DATA
        $data = new users_status;
        $data->ref_id = $request->ref_id;
        $data->user_id = $request->user_id;
        $data->pegawai_id = $request->pegawai_id;
        $data->keterangan = $request->ket;
        $data->tgl_berlaku = $now;
        $data->status = true;
        $data->save();

        // CEK DATA & SAVE LOG
        $cekData = referensi::find($request->ref_id);
        $cekPegawai = users::find($request->pegawai_id);
        datalogs::record($request->user_id, 'Baru saja melakukan penambahan Status Pegawai '.$cekPegawai->nama.' menjadi '.$cekData->deskripsi, 'Berlaku mulai tanggal '.$tgl_berlaku, null, $data, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return response()->json($tgl, 200);
    }

    function tambahRotasi(Request $request)
    {
        $now = Carbon::now();
        $tgl = $now->isoFormat('dddd, D MMMM Y, HH:mm a');
        $tgl_berlaku = $now->isoFormat('YYYY-MM-DD');

        // VALIDASI DATA
        $validasi = users_rotasi::where('pegawai_id',$request->pegawai_id)->orderBy('created_at','desc')->first();
        if (!empty($validasi) || $validasi != '') {
            $validasi->status = 0;
            $validasi->save();
        }

        // CHECKING DATA
        $getRoleBefore = model_has_roles::select('role_id')
            ->where('model_id',$request->pegawai_id)
            ->get();
        foreach ($getRoleBefore as $key => $value) {
            $roleBefore[] = `"`.$value->role_id.`"`;
        }

        // SAVING DATA ROTASI
        $data = new users_rotasi;
        $data->ref_id = $request->ref_id;
        $data->user_id = $request->user_id;
        $data->pegawai_id = $request->pegawai_id;
        $data->before = json_encode($roleBefore); // ["106","109"]
        $data->after = $request->jabatan; // ["105","106","109"]
        $data->keterangan = $request->ket;
        $data->tgl_berlaku = $now;
        $data->status = true;
        $data->save();

        // SAVING DATA MODEL AS ROLES
        model_has_roles::where('model_id', $request->pegawai_id)->delete();
        foreach (json_decode($request->jabatan) as $key => $value) {
            $model = new model_has_roles;
            $model->role_id = $value;
            $model->model_type = 'App\User';
            $model->model_id = $request->pegawai_id;
            $model->save();
        }

        // CEK DATA & SAVE LOG
        $cekData = referensi::find($request->ref_id);
        $cekPegawai = users::find($request->pegawai_id);
        datalogs::record($request->user_id, 'Baru saja melakukan '.$cekData->deskripsi.' pada Rotasi Jabatan Pegawai '.$cekPegawai->nama, 'Berlaku mulai tanggal '.$tgl_berlaku, json_encode($roleBefore), $request->jabatan, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return response()->json($tgl, 200);
    }

    // FUNCTION SHOW UBAH
    function showUbahPenetapan($id)
    {
        $show = users_status::where('id', $id)->first();
        $ref_penetapan = referensi::where('ref_jenis',10)->get(); // 10 is Jenis Penetapan Pegawai

        $data = [
            'show' => $show,
            'ref_penetapan' => $ref_penetapan,
        ];

        return response()->json($data, 200);
    }

    function showUbahRotasi($id)
    {
        $show = users_rotasi::where('id', $id)->first();
        $ref_rotasi = referensi::where('ref_jenis',9)->get(); // 10 is Jenis Rotasi Pegawai

        $data = [
            'show' => $show,
            'ref_rotasi' => $ref_rotasi,
        ];

        return response()->json($data, 200);
    }

    // FUNCTION UBAH
    function ubahPenetapan(Request $request)
    {
        $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');

        $data = users_status::find($request->id);
        $data->ref_id       = $request->ref_id;
        $data->user_id      = $request->user_id;
        $data->keterangan   = $request->keterangan;
        $data->save();

        // CEK DATA & SAVE LOG
        $cekData = referensi::find($request->ref_id);
        datalogs::record($request->user_id, 'Baru saja melakukan perubahan Status Pegawai menjadi '.$cekData->deskripsi.' pada record ID : '.$request->id, $request->keterangan, null, $data, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return response()->json($now, 200);
    }

    // FUNCTION HAPUS
    function hapusPenetapan($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = users_status::find($id);

        // Validasi Pengambilan Record Lama
        $cek = users_status::where('pegawai_id',$data->pegawai_id)
                ->where('status',false)
                ->orderBy('created_at','desc')
                ->first();
        if (!empty($cek) || $cek != '') {
            $cek->status = 1;
            $cek->save();
        }

        // Proses Hapus Data dari DB
        $data->status = 0;
        $data->save();
        $data->delete();

        // CEK DATA & SAVE LOG
        $cekData = referensi::find($data->ref_id);
        datalogs::record($data->user_id, 'Baru saja melakukan penghapusan Status Pegawai ID : '.$id, null, null, $data, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return response()->json($tgl, 200);
    }

    function hapusRotasi($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = users_rotasi::find($id);

        // SAVING DATA MODEL AS ROLES
        model_has_roles::where('model_id', $data->pegawai_id)->delete();
        foreach (json_decode($data->before) as $key => $value) {
            $model = new model_has_roles;
            $model->role_id = $value;
            $model->model_type = 'App\User';
            $model->model_id = $data->pegawai_id;
            $model->save();
        }

        // Proses Hapus Data dari DB
        $data->delete();

        // CEK DATA & SAVE LOG
        $cekData = referensi::find($data->ref_id);
        datalogs::record($data->user_id, 'Baru saja melakukan penghapusan Rotasi Jabatan Pegawai ID : '.$id, null, null, $data, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return response()->json($tgl, 200);
    }
}
