<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\kepegawaian\pd;
use App\Models\kepegawaian\pd_ceklis;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File,Storage;

class PDController extends Controller
{
    function index()
    {
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        // $show  = pd::get();

        // $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //     ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //     ->select('roles.name as nama_role', 'users.id as id_user')
        //     ->get();

        $data = [
            // 'show' => $show,
            'users' => $users,
            // 'role' => $role,
        ];

        return view('pages.kepegawaian.pd.index')->with('list', $data);
    }

    function table()
    {
        $users  = users::select('id','nama')->where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = pd::join('users','users.id','=','kepegawaian_pd.user_id')
                    ->select('users.nama as nama_user','kepegawaian_pd.*')
                    ->get();

        $data = [
            'show' => $show,
            'users' => $users,
        ];

        return response()->json($data, 200);
    }

    function tambah(Request $request)
    {
        $request->validate([
            'file' => ['max:2000|mimes:pdf'],
        ]);

        $push = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $uploadedFile = $request->file('file');
        $title = $uploadedFile->getClientOriginalName();
        $validasiFile = pd::where('title',$title)->first();
        if (empty($validasiFile)) {
            // simpan berkas yang diunggah ke sub-direktori 'public/files'
            // direktori 'files' otomatis akan dibuat jika belum ad
            $path = $uploadedFile->store('public/files/kepegawaian/pd/'.$request->user);

            $data = new pd;
            $data->user_id = $request->user;
            $data->pegawai_id = $request->pegawai;
            $data->jenis = $request->jenis;
            $data->tgl = $request->tgl;
            $data->acara = $request->acara;
            $data->lokasi = $request->lokasi;
            $data->title = $title;
            $data->filename = $path;
            $data->save();

            return response()->json($push, 200);
        } else {
            return Response::json(array(
                'message' => 'File sudah ada/pernah diupload sebelumnya!',
                'code' => 500,
            ));
        }
    }

    function download($id)
    {
        $data = pd::where('id', $id)->first();
        $filename = $data->filename;
        $title = $data->title;
        return Storage::download($filename, $title);
    }

    function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = pd::find($id);

        // Proses Hapus Lampiran
        Storage::delete($data->filename);

        // Hapus Record DB
        $data->delete();

        return response()->json($tgl, 200);
    }
}
