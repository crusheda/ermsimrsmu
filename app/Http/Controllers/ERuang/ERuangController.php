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

        // INITIALIZE

        // VALIDASI TANGGAL
        $getData = eruang::select('eruang.*','users.nama as nama_user','eruang_ref.nama as nama_ruangan')
                            ->where('eruang.tgl',$tgl)
                            ->where('eruang.id_ruangan',$request->ruangan)
                            ->join('users','users.id','=','eruang.id_user')
                            ->join('eruang_ref','eruang_ref.id','=','eruang.id_ruangan')
                            ->first();
        $getJamMulai = Carbon::parse($request->jam_mulai)->isoFormat('HH');
        $getJamSelesai = Carbon::parse($request->jam_selesai)->isoFormat('HH');
        $getMenitMulai = Carbon::parse($request->jam_mulai)->isoFormat('mm');
        $getMenitSelesai = Carbon::parse($request->jam_selesai)->isoFormat('mm');

        if (!empty($getData)) {
            $dbJamMulai = Carbon::parse($getData->jam_mulai)->isoFormat('HH:mm');
            $dbJamSelesai = Carbon::parse($getData->jam_selesai)->isoFormat('HH:mm');
            $dbMulai = Carbon::parse($getData->jam_mulai)->isoFormat('HH');
            $dbSelesai = Carbon::parse($getData->jam_selesai)->isoFormat('HH');
            $diffdb = $dbSelesai - $dbMulai;
            $diffinp = $getJamSelesai - $getJamMulai;
            if ($getJamMulai == $getJamSelesai) {
                if ($getMenitMulai == $getMenitSelesai) {
                    return Response::json(array(
                        'message' => 'Jam tidak valid/tidak boleh sama!',
                        'code' => 400,
                    ));
                    // return response()->json('Jam tidak valid/tidak boleh sama!', 400);
                } else {
                    if ($getMenitMulai < $getMenitSelesai) {
                        $cekVal = null;
                        for ($i=0; $i <= $diffdb; $i++) { // 9,10,11
                            for ($y=0; $y <= $diffinp; $y++) { // 11,12
                                if ($dbMulai+$i == $getJamMulai+$y) {
                                    $cekVal = $dbMulai+$i;
                                }
                            }
                        }
                        if ($cekVal != null) {
                            return Response::json(array(
                                'message' => 'Ruangan '.$getData->nama_ruangan.' sudah terpesan oleh '.$getData->nama_user.' pada jam '.$dbJamMulai.' - '.$dbJamSelesai.', silakan memilih Ruangan/Jam lainnya',
                                'code' => 400,
                            ));
                        } else {
                            $data = new eruang;
                            $data->id_user      = $request->user;
                            $data->id_ruangan   = $request->ruangan;
                            $data->agenda       = $request->agenda;
                            $data->tgl          = $tgl;
                            $data->jam_mulai    = $request->jam_mulai;
                            $data->jam_selesai  = $request->jam_selesai;
                            $data->ket          = $request->ket;
                            $data->gizi         = $request->gizi;
                            // $data->save();
                            return Response::json(array(
                                'message' => 'Peminjaman Ruangan Berhasil pada '.$push,
                                'code' => 200,
                            ));
                        }
                    } else {
                        return Response::json(array(
                            'message' => 'Menit Jam Mulai tidak boleh melebihi Menit Jam Selesai',
                            'code' => 400,
                        ));
                    }
                }
            } else {
                if ($getJamMulai < $getJamSelesai) {
                    if ($getMenitMulai <= $getMenitSelesai) {
                        $cekVal = null;
                        for ($i=0; $i <= $diffdb; $i++) { // 9,10,11
                            for ($y=0; $y <= $diffinp; $y++) { // 11,12
                                if ($dbMulai+$i == $getJamMulai+$y) {
                                    $cekVal = $dbMulai+$i;
                                }
                            }
                        }
                        if ($cekVal != null) {
                            return Response::json(array(
                                'message' => 'Ruangan '.$getData->nama_ruangan.' sudah terpesan oleh '.$getData->nama_user.' pada jam '.$dbJamMulai.' - '.$dbJamSelesai.', silakan memilih Ruangan/Jam lainnya',
                                'code' => 400,
                            ));
                        } else {
                            $data = new eruang;
                            $data->id_user      = $request->user;
                            $data->id_ruangan   = $request->ruangan;
                            $data->agenda       = $request->agenda;
                            $data->tgl          = $tgl;
                            $data->jam_mulai    = $request->jam_mulai;
                            $data->jam_selesai  = $request->jam_selesai;
                            $data->ket          = $request->ket;
                            $data->gizi         = $request->gizi;
                            // $data->save();
                            return Response::json(array(
                                'message' => 'Peminjaman Ruangan Berhasil pada '.$push,
                                'code' => 200,
                            ));
                        }
                    } else {
                        return Response::json(array(
                            'message' => 'Menit Jam Mulai tidak boleh melebihi Menit Jam Selesai',
                            'code' => 400,
                        ));
                    }
                } else {
                    return Response::json(array(
                        'message' => 'Jam Mulai tidak boleh melebihi Jam Selesai',
                        'code' => 400,
                    ));
                }
            }

            // $dbMulai = Carbon::parse($getData->jam_mulai)->isoFormat('HH');
            // $dbSelesai = Carbon::parse($getData->jam_selesai)->isoFormat('HH');

            // if($getJamMulai >= $dbMulai && $getJamMulai <= $dbSelesai) {
            //     return response()->json(' - jam awal tidak valid',201);
            //     // return response()->json('Ruangan '.$getData->nama_ruangan.' sudah terpesan oleh '.$getData->nama_user.', silakan memilih Ruangan/Jam lainnya', 400);
            // } else {
            //     if($getJamSelesai >= $dbMulai && $getJamSelesai <= $dbSelesai) {
            //         return response()->json(' - jam selesai tidak valid',201);
            //         // return response()->json('Ruangan '.$getData->nama_ruangan.' sudah terpesan oleh '.$getData->nama_user.', silakan memilih Ruangan/Jam lainnya', 400);
            //     } else {
            //         echo " - Ruangan tersedia";
            //     }
            // }
            // print_r($getJamSelesai);
            // // print_r();
            // die();
            // return response()->json('Ruangan '.$getData->nama_ruangan.' sudah terpesan oleh '.$getData->nama_user.', silakan memilih Ruangan/Jam lainnya', 400);
        } else {
            if ($getJamMulai == $getJamSelesai) {
                if ($getMenitMulai == $getMenitSelesai) {
                    return Response::json(array(
                        'message' => 'Jam tidak valid/tidak boleh sama!',
                        'code' => 400,
                    ));
                } else {
                    if ($getMenitMulai < $getMenitSelesai) {
                        $data = new eruang;
                        $data->id_user      = $request->user;
                        $data->id_ruangan   = $request->ruangan;
                        $data->agenda       = $request->agenda;
                        $data->tgl          = $tgl;
                        $data->jam_mulai    = $request->jam_mulai;
                        $data->jam_selesai  = $request->jam_selesai;
                        $data->ket          = $request->ket;
                        $data->gizi         = $request->gizi;
                        // $data->save();
                        return Response::json(array(
                            'message' => 'Peminjaman Ruangan Berhasil pada '.$push,
                            'code' => 200,
                        ));
                    } else {
                        return Response::json(array(
                            'message' => 'Menit Jam Mulai tidak boleh melebihi Menit Jam Selesai',
                            'code' => 400,
                        ));
                        // return response()->json('Menit Jam Mulai tidak boleh melebihi Menit Jam Selesai', 400);
                    }
                }
            } else {
                if ($getJamMulai < $getJamSelesai) {
                    $data = new eruang;
                    $data->id_user      = $request->user;
                    $data->id_ruangan   = $request->ruangan;
                    $data->agenda       = $request->agenda;
                    $data->tgl          = $tgl;
                    $data->jam_mulai    = $request->jam_mulai;
                    $data->jam_selesai  = $request->jam_selesai;
                    $data->ket          = $request->ket;
                    $data->gizi         = $request->gizi;
                    // $data->save();
                    return Response::json(array(
                        'message' => 'Peminjaman Ruangan Berhasil pada '.$push,
                        'code' => 200,
                    ));
                } else {
                    return Response::json(array(
                        'message' => 'Jam Mulai tidak boleh melebihi Jam Selesai',
                        'code' => 400,
                    ));
                    // return response()->json('Jam Mulai tidak boleh melebihi Jam Selesai', 400);
                }
            }
        }

        // return response()->json($push, 200);
        return Response::json(array(
            'message' => 'Peminjaman Ruangan Berhasil pada '.$push,
            'code' => 200,
        ));
    }

    function table()
    {
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
        $show = eruang::select('eruang.*','users.nama as nama_user','users.no_hp','eruang_ref.nama as nama_ruangan','eruang_ref.kapasitas')
                    ->join('users','users.id','=','eruang.id_user')
                    ->join('eruang_ref','eruang_ref.id','=','eruang.id_ruangan')
                    ->orderBy('eruang.updated_at','DESC')
                    ->get();
        // $ruangan = eruang_ref::orderBy('nama','ASC')->get();

        $data = [
            'role' => $role,
            'show' => $show,
            // 'ruangan' => $ruangan,
        ];

        return response()->json($data);
    }

    function getUbah($id)
    {
        $show = eruang::select('eruang.*','users.nama as nama_user','eruang_ref.id as id_ruangan_ref','eruang_ref.nama as nama_ruangan','eruang_ref.kapasitas')
                    ->join('users','users.id','=','eruang.id_user')
                    ->join('eruang_ref','eruang_ref.id','=','eruang.id_ruangan')
                    ->where('eruang.id',$id)
                    ->orderBy('eruang.updated_at','DESC')
                    ->first();

        $ruangan = eruang_ref::orderBy('nama','ASC')->get();

        $data = [
            'show' => $show,
            'ruangan' => $ruangan,
        ];

        return response()->json($data, 200);
    }

    function ubah(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = eruang::find($request->id);
        $data->id_user = $request->user;
        $data->id_ruangan = $request->ruangan;
        $data->agenda = $request->agenda;
        $data->tgl = $request->tgl;
        $data->ket = $request->ket;
        $data->gizi = $request->gizi;

        $data->save();

        return response()->json($tgl, 200);
    }

    function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = eruang::find($id);
        $data->delete();

        return response()->json($tgl, 200);
    }

    function display()
    {
        $show = eruang::select('eruang.*','users.nama as nama_user','users.no_hp','users_foto.filename as foto_profil','eruang_ref.id as id_ruangan_ref','eruang_ref.nama as nama_ruangan','eruang_ref.kapasitas')
                    ->join('users','users.id','=','eruang.id_user')
                    ->join('users_foto','users.id','=','users_foto.user_id')
                    ->join('eruang_ref','eruang_ref.id','=','eruang.id_ruangan')
                    ->orderBy('eruang.jam_mulai','asc')
                    ->limit(6)->get();
        $now = Carbon::now()->isoFormat('HH:mm:ss');

        $data = [
            'show' => $show,
            'now' => $now,
        ];

        return response()->json($data, 200);
    }
}
