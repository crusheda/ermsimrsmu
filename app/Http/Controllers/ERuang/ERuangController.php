<?php

namespace App\Http\Controllers\ERuang;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\eruang_ref;
use App\Models\eruang;
use App\Models\roles;
use App\Models\User;
use Carbon\Carbon;
use Storage;
use Auth;
use \PDF;
use Validator,Redirect,Response,File;

class ERuangController extends Controller
{
    function index()
    {
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
        $show = eruang::get();
        $ruangan = eruang_ref::orderBy('nama','ASC')->get();

        $data = [
            'role' => $role,
            'show' => $show,
            'ruangan' => $ruangan,
        ];

        return view('pages.eruang.index')->with('list',$data);
    }

    function store(Request $request) {
        $carbon = Carbon::now();
        $tgl = $carbon->isoFormat('dddd, D MMMM Y, HH:mm a');

        // KONVERSI TGL
        $tgl_mulai = Carbon::parse($request->tgl_mulai)->isoFormat('YYYY-MM-DD'); // 28-05-2024 menjadi 2024-05-28
        $tgl_selesai = Carbon::parse($request->tgl_selesai)->isoFormat('YYYY-MM-DD');

        // VALIDASI
        $getData = eruang::whereDate('tgl_mulai','>=', $tgl_mulai)
                    ->whereDate('tgl_selesai','<=', $tgl_selesai)
                    ->whereDate('tgl_selesai','>',)
                    ->whereBetween('tgl_mulai',[])
                    ->first();
        print_r($getData);
        die();

        $data = new eruang;
        $data->id_user      = $request->user;
        $data->id_ruangan   = $request->ruangan;
        $data->tgl_mulai    = $tgl_mulai;
        $data->tgl_selesai  = $tgl_selesai;
        $data->jam_mulai    = $request->jam_mulai;
        $data->jam_selesai  = $request->jam_selesai;
        $data->gizi         = $request->gizi;
        $data->save();

        return response()->json($tgl, 200);
    }
}
