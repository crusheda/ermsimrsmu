<?php

namespace App\Http\Controllers\Kepegawaian\Rekrutmen;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\kepegawaian\rekrutmen\pengumuman;
use App\Models\kepegawaian\rekrutmen\registrasi;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File;

class RegistrasiController extends Controller
{
    function index()
    {
        if (
                Auth::user()->getPermission('admin_kepegawaian') == true ||
                Auth::user()->getPermission('admin_kepegawaian_kepala') == true
            ) {

            $pengumuman = pengumuman::where('status',1)->whereNull('deleted_at')->orderBy('mulai','DESC')->get();

            $data = [
                'pengumuman' => $pengumuman
            ];

            return view('pages.kepegawaian.rekrutmen.peserta.index')->with('list', $data);
        } else {
            return redirect()->back()->withErrors("Maaf, Anda tidak memiliki akses untuk membuka halaman Daftar Peserta!");
        }
    }

    function table($id)
    {
        if ($id == 0) {
            $show = registrasi::where('status',1)
                ->whereNull('deleted_at')
                ->get()
                ->map(function ($item) {
                    $item->encrypted_id = urlencode(Crypt::encryptString($item->id));
                    return $item;
                });
        } else {
            $show = registrasi::where('status',1)
                ->where('id_pengumuman',$id)
                ->whereNull('deleted_at')
                ->get()
                ->map(function ($item) {
                    $item->encrypted_id = urlencode(Crypt::encryptString($item->id));
                    return $item;
                });
            // $show = registrasi::where('status',1)->where('id_pengumuman',$id)->whereNull('deleted_at')->get();
        }

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }
}
