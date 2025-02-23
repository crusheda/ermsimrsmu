<?php

namespace App\Http\Controllers\Kepegawaian\Rekrutmen;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\users;
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
}
