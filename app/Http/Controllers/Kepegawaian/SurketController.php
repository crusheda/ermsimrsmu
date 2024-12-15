<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\kepegawaian\surket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File;

class SurketController extends Controller
{
    function index()
    {
        if (Auth::user()->getPermission('admin_kepegawaian') == true) {
            return view('pages.kepegawaian.surket.index-admin');
        } else {
            $user = users::where('id',Auth::user()->id)->first();
            $users  = users::where('nik','!=',null)->orderBy('nama', 'asc')->get();
            // $show  = idcard::get();
            $kategori = referensi::where('ref_jenis',13)->get();
            if ($user->s3) {
                $pendidikan = 'S3 - '.$user->s3;
            } else {
                if ($user->s2) {
                    $pendidikan = 'S2 - '.$user->s2;
                } else {
                    if ($user->s1_profesi) {
                        $pendidikan = 'S1 Profesi - '.$user->s1_profesi;
                    } else {
                        if ($user->s1) {
                            $pendidikan = 'S1 - '.$user->s1;
                        } else {
                            if ($user->d4) {
                                $pendidikan = 'D4 - '.$user->d4;
                            } else {
                                if ($user->d3) {
                                    $pendidikan = 'D3 - '.$user->d3;
                                } else {
                                    if ($user->d2) {
                                        $pendidikan = 'D2 - '.$user->d2;
                                    } else {
                                        if ($user->d1) {
                                            $pendidikan = 'D1 - '.$user->d1;
                                        } else {
                                            if ($user->sma) {
                                                $pendidikan = $user->sma;
                                            } else {
                                                if ($user->smp) {
                                                    $pendidikan = $user->smp;
                                                } else {
                                                    if ($user->sd) {
                                                        $pendidikan = $user->sd;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $data = [
                // 'show' => $show,
                'pendidikan' => $pendidikan,
                'user' => $user,
                'users' => $users,
                'kategori' => $kategori,
            ];

            return view('pages.kepegawaian.surket.index-user')->with('list', $data);
        }
    }

    // USER
    function tableUser($id)
    {
        $show  = surket::join('referensi','referensi.id','=','kepegawaian_surket.ref_id')->where('kepegawaian_surket.pegawai_id',$id)->select('referensi.deskripsi as kategori','kepegawaian_surket.*')->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function tambah(Request $request)
    {
        $push = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $user = users::where('id',$request->pegawai)->first();

        $validasi = surket::where('ref_id',$request->kategori)->where('pegawai_id',$request->pegawai)->get();
        $valid = 0;
        foreach ($validasi as $key => $value) {
            if ($value->progress == 0 || $value->progress == 1) {
                $valid = 1;
            }
        }
        if ($valid == 1) {
            return Response::json(array(
                'message' => 'Gagal order karena masih terdapat pengajuan surat yang belum diselesaikan',
                'code' => 500,
            ));
        } else {
            $validasi_no = surket::orderBy('no_surat','desc')->first();
            if (empty($validasi_no)) {
                $no_surat = 1;
            } else {
                $no_surat = $validasi_no->no_surat + 1; // sprintf("%02d", $num)
            }

            $data = new surket;
            $data->ref_id               = $request->kategori;
            $data->pegawai_id           = $request->pegawai;
            $data->no_surat             = $no_surat;
            $data->th_surat             = Carbon::now()->isoFormat('YYYY');
            $data->tgl_surat            = Carbon::now()->isoFormat('YYYY-MM-DD');
            $data->pegawai_nama         = $request->nama;
            $data->pegawai_ttl          = $request->ttl;
            $data->pegawai_pendidikan   = $request->pendidikan;
            $data->pegawai_alamat       = $request->alamat;
            $data->pegawai_tmt          = $request->tmt;
            if ($user->tat) {
                $data->pegawai_tat      = $user->tat;
            }
            $data->progress             = 0;
            $data->save();

            return response()->json($push);
        }
    }

    function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = surket::find($id);
        $data->delete();

        return response()->json($tgl, 200);
    }

    // ADMIN
    function tableAdmin()
    {
        $show  = surket::join('referensi','referensi.id','=','kepegawaian_surket.ref_id')
                ->select('referensi.deskripsi as kategori','kepegawaian_surket.*')
                ->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function verif($id,$user)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = surket::find($id);
        $data->progress = 1;
        $data->valid = $user;
        $data->tgl_valid = Carbon::now();
        $data->save();

        return response()->json($tgl, 200);
    }

    function unverif($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = surket::find($id);
        $data->progress = 0;
        $data->valid = null;
        $data->tgl_valid = null;
        $data->save();

        return response()->json($tgl, 200);
    }

    function tolak($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = surket::find($id);
        $data->progress = 2;
        $data->tgl_valid = Carbon::now();
        $data->save();

        return response()->json($tgl, 200);
    }

    function batalTolak($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = surket::find($id);
        $data->progress = 0;
        $data->tgl_valid = null;
        $data->save();

        return response()->json($tgl, 200);
    }
}
