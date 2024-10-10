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
            $users  = users::where('nik','!=',null)->orderBy('nama', 'asc')->get();
            // $show  = idcard::get();
            $kategori = referensi::where('ref_jenis',13)->get();

            $data = [
                // 'show' => $show,
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
            $data = new surket;
            $data->ref_id           = $request->kategori;
            $data->pegawai_id          = $request->pegawai;
            $data->pegawai_nama         = $user->nama;
            $data->pegawai_ttl          = Carbon::parse($user->tgl_lahir)->isoFormat('dddd, D MMMM Y');
            // VALIDASI PENDIDIKAN
            if ($user->s3 == null) {
                if ($user->s2 == null) {
                    if ($user->s1_profesi == null) {
                        if ($user->s1 == null) {
                            if ($user->d4 == null) {
                                if ($user->d3 == null) {
                                    if ($user->d2 == null) {
                                        if ($user->d1 == null) {
                                            if ($user->sma == null) {
                                                if ($user->smp == null) {
                                                    if ($user->sd == null) {
                                                        $data->pegawai_pendidikan    = "-";
                                                    } else {
                                                        $data->pegawai_pendidikan    = $user->sd;
                                                    }
                                                } else {
                                                    $data->pegawai_pendidikan    = $user->smp;
                                                }
                                            } else {
                                                $data->pegawai_pendidikan    = $user->sma;
                                            }
                                        } else {
                                            $data->pegawai_pendidikan    = $user->d1;
                                        }
                                    } else {
                                        $data->pegawai_pendidikan    = $user->d2;
                                    }
                                } else {
                                    $data->pegawai_pendidikan    = $user->d3;
                                }
                            } else {
                                $data->pegawai_pendidikan    = $user->d4;
                            }
                        } else {
                            $data->pegawai_pendidikan    = $user->s1;
                        }
                    } else {
                        $data->pegawai_pendidikan    = $user->s1_profesi;
                    }
                } else {
                    $data->pegawai_pendidikan    = $user->s2;
                }
            } else {
                $data->pegawai_pendidikan    = $user->s3;
            }
            $data->pegawai_alamat      = $user->alamat_ktp;
            $data->progress             = 0;
            $data->save();

            return response()->json($push);
        }
    }

    function hapus()
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
        $show  = surket::join('referensi','referensi.id','=','kepegawaian_surket.ref_id')->select('referensi.deskripsi as kategori','kepegawaian_surket.*')->get();

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
        $data->valid = null;
        $data->tgl_valid = null;
        $data->save();

        return response()->json($tgl, 200);
    }

    function ubahStatus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = surket::find($id);
        $data->progress = $data->progress + 1;
        $data->save();

        return response()->json($tgl, 200);
    }

    function tolak($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = surket::find($id);
        $data->progress = 3;
        $data->save();

        return response()->json($tgl, 200);
    }
}
