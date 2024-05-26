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
        $push = $carbon->isoFormat('dddd, D MMMM Y, HH:mm a');

        $tgl = Carbon::parse($request->tgl)->isoFormat('YYYY-MM-DD'); // 28-05-2024 menjadi 2024-05-28

        // $query_string = "SELECT * FROM eruang WHERE (tgl_mulai BETWEEN '2024-05-28' AND '2024-05-29') AND deleted_at IS NULL";
        // $query_string = "SELECT * FROM eruang WHERE (tgl_mulai >= $tgl_mulai OR tgl_mulai <= $tgl_selesai) OR (tgl_selesai <= $tgl_selesai OR tgl_selesai >= $tgl_mulai) AND deleted_at IS NULL";
        // $query_string = "SELECT * FROM eruang WHERE (tgl_mulai BETWEEN $tgl_mulai AND $tgl_selesai) OR (tgl_selesai BETWEEN $tgl_mulai AND $tgl_selesai) AND deleted_at IS NULL";
        // $show = DB::select($query_string);
        // $cek = abs(strtotime($tgl_selesai) - strtotime($tgl_mulai));
        // $years = floor($cek / (365*60*60*24));
        // $months = floor(($cek - $years * 365*60*60*24) / (30*60*60*24));
        // $days = floor(($cek - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        // printf("%d days\n", $days);
        // die();

        // VALIDASI
        $getData = eruang::select('eruang.*','users.nama as nama_user','eruang_ref.nama as nama_ruangan')
                            ->where('eruang.tgl',$tgl)
                            ->join('users','users.id','=','eruang.id_user')
                            ->join('eruang_ref','eruang_ref.id','=','eruang.id_ruangan')
                            ->first();
        $getJamMulai = Carbon::parse($request->jam_mulai)->isoFormat('HH');
        $getJamSelesai = Carbon::parse($request->jam_selesai)->isoFormat('HH');
        $getMenitMulai = Carbon::parse($request->jam_mulai)->isoFormat('mm');
        $getMenitSelesai = Carbon::parse($request->jam_selesai)->isoFormat('mm');

        // print_r($getJamSelesai);
        // die();

        if (!empty($getData)) {
            return response()->json('Ruangan '.$getData->nama_ruangan.' sudah terpesan oleh '.$getData->nama_user.', silakan memilih Ruangan/Jam lainnya', 400);
        } else {
            if ($getJamMulai == $getJamSelesai) {
                if ($getMenitMulai == $getMenitSelesai) {
                    return response()->json('Jam tidak valid/tidak boleh sama!', 400);
                } else {
                    if ($getMenitMulai < $getMenitSelesai) {
                        $data = new eruang;
                        $data->id_user      = $request->user;
                        $data->id_ruangan   = $request->ruangan;
                        $data->tgl          = $tgl;
                        $data->jam_mulai    = $request->jam_mulai;
                        $data->jam_selesai  = $request->jam_selesai;
                        $data->gizi         = $request->gizi;
                        // $data->save();
                    } else {
                        return response()->json('Menit Jam Mulai tidak boleh melebihi Menit Jam Selesai', 400);
                    }
                }
            } else {
                if ($getJamMulai < $getJamSelesai) {
                    $data = new eruang;
                    $data->id_user      = $request->user;
                    $data->id_ruangan   = $request->ruangan;
                    $data->tgl          = $tgl;
                    $data->jam_mulai    = $request->jam_mulai;
                    $data->jam_selesai  = $request->jam_selesai;
                    $data->gizi         = $request->gizi;
                    // $data->save();
                } else {
                    return response()->json('Jam Mulai tidak boleh melebihi Jam Selesai', 400);
                }
            }
        }

        return response()->json($push, 200);
    }
}
