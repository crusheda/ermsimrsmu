<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\kepegawaian\jadwal;
use App\Models\kepegawaian\jadwal_detail;
use App\Models\kepegawaian\ref_jadwal_shift;
use App\Models\kepegawaian\ref_jadwal_users;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File,Storage;

class JadwalController extends Controller
{
    function index()
    {
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        // $show  = jadwal::get();

        // $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //     ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //     ->select('roles.name as nama_role', 'users.id as id_user')
        //     ->get();

        $data = [
            // 'show' => $show,
            'users' => $users,
            // 'role' => $role,
        ];

        return view('pages.kepegawaian.jadwal.index-user')->with('list', $data);
    }

    function storePengajuan(Request $request)
    {
        // $push = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $shift = ref_jadwal_shift::where('pegawai_id',$request->pegawai)->first();
        $users = ref_jadwal_users::where('pegawai_id',$request->pegawai)->first();

        if (empty($shift)) {
            return Response::json(array(
                'message' => 'Data Shift tidak ditemukan. Silakan melengkapi Referensi Jaga Shift!',
                'code' => 500,
            ));
        } else {
            if (empty($users)) {
                return Response::json(array(
                    'message' => 'Data Staf tidak ditemukan. Silakan melengkapi data staf Anda!',
                    'code' => 500,
                ));
            } else {
                $bulan = Carbon::parse($request->tgl)->isoFormat('MM');
                $tahun = Carbon::parse($request->tgl)->isoFormat('YYYY');

                $data = new jadwal;
                $data->pegawai_id = $request->pegawai;
                $data->staf = $users->staf;
                $data->bulan = $bulan;
                $data->tahun = $tahun;
                $data->keterangan = $request->keterangan;
                $data->progress = 1;
                $data->save();

                $getData = jadwal::where('pegawai_id',$request->pegawai)->where('progress',1)->orderBy('updated_at','desc')->first();
                return Response::json(array(
                    'message' => $getData,
                    'code' => 200,
                ));
            }
        }
    }

    function cekShift($id,$user)
    {
        $ref_shift = ref_jadwal_shift::where('singkat',$id)->where('pegawai_id',$user)->first();

        if (empty($ref_shift)) {
            return Response::json(array(
                'message' => 'Shift Tidak Ditemukan',
                'code' => 500,
            ));
        } else {
            return Response::json(array(
                'message' => $ref_shift,
                'code' => 200,
            ));
        }

    }

    function formTambah($id)
    {
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $jadwal  = jadwal::where('id',$id)->where('pegawai_id',Auth::user()->id)->first();
        $ref_shift = ref_jadwal_shift::where('pegawai_id',Auth::user()->id)->first();
        $ref_users = ref_jadwal_users::where('pegawai_id',Auth::user()->id)->first();

        $data = [
            // 'show' => $show,
            'jadwal' => $jadwal,
            'ref_shift' => $ref_shift,
            'ref_users' => $ref_users,
            'users' => $users,
        ];

        return view('pages.kepegawaian.jadwal.user.tambah')->with('list', $data);
    }
}
