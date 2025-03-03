<?php

namespace App\Http\Controllers\Kepegawaian\Rekrutmen;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\datalogs;
use App\Models\kepegawaian\ref_jenjang_pendidikan;
use App\Models\kepegawaian\rekrutmen\pengumuman;
use App\Models\kepegawaian\rekrutmen\registrasi;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File;

class PengumumanController extends Controller
{
    function index()
    {
        if (Auth::user()->getPermission('admin_kepegawaian') == true) {
            $jenjang_pendidikan = ref_jenjang_pendidikan::get();

            $data = [
                'pendidikan' => $jenjang_pendidikan,
            ];

            return view('pages.kepegawaian.rekrutmen.pengumuman.index')->with('list', $data);
        } else {
            return redirect()->back()->withErrors("Maaf, Anda tidak memiliki akses untuk membuka halaman Rekrutmen/Lowongan Kerja")->withInput();
        }
    }

    function table()
    {
        $show  = pengumuman::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function simpan(Request $request)
    {
        $push = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $validasi = pengumuman::where('nama',$request->nama)->count();
        if ($validasi > 0) {
            return Response::json(array(
                'message' => 'Nama Kebutuhan sudah pernah digunakan, silakan menggunakan nama lain.',
                'code' => 400,
            ));
        } else {
            $data = new pengumuman;
            $data->token = Crypt::encryptString($request->nama); // decryptString to Decrypt
            $data->unit = $request->unit;
            $data->nama = $request->nama;
            $data->jumlah = $request->jumlah;
            $data->kualifikasi = $request->kualifikasi;
            $data->tugas = $request->tugas;
            $data->keahlian = $request->keahlian;
            $data->persyaratan = $request->persyaratan;
            $data->umur_min = $request->umur_min;
            $data->umur_max = $request->umur_max;
            $data->kuota = $request->kuota;
            $data->mulai = $request->mulai;
            $data->selesai = $request->selesai;
            $data->keterangan = $request->keterangan;
            // $data->pegawai_id = $request->pegawai;
            $data->save();

            datalogs::record($request->pegawai, 'Baru saja melakukan penambahan Lowongan Kerja '.$request->nama, 'dari '.$request->mulai.' sampai '.$request->selesai, null, $data, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');
            return Response::json(array(
                'message' => $push,
                'code' => 200,
            ));
        }
    }

    function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = pengumuman::find($id);
        $data->delete();

        return response()->json($tgl, 200);
    }

    function makeEncrypt($id)
    {
        return response()->json(Crypt::encryptString($id), 200);
    }

    function makeDecrypt($id)
    {
        return response()->json(Crypt::decryptString($id), 200);
    }
}
