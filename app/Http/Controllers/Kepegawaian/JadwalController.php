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

    function formTambah($id)
    {
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $jadwal  = jadwal::where('id',$id)->where('pegawai_id',Auth::user()->id)->first();
        $ref_shift = ref_jadwal_shift::where('pegawai_id',Auth::user()->id)->get();
        $ref_users = ref_jadwal_users::where('pegawai_id',Auth::user()->id)->first();
        $jml_tgl = Carbon::create($jadwal->tahun, $jadwal->bulan)->format('t');

        $data = [
            // 'show' => $show,
            'jadwal' => $jadwal,
            'ref_shift' => $ref_shift,
            'ref_users' => $ref_users,
            'users' => $users,
            'jml_tgl' => $jml_tgl,
        ];

        return view('pages.kepegawaian.jadwal.user.tambah')->with('list', $data);
    }

    function formUbah($id)
    {
        $jadwal  = jadwal::where('id',$id)->first();
        if ($jadwal->progress == 0 || $jadwal->progress == 2) {
            if ($jadwal->progress == 0) {
                $status = 'Ditolak';
            } else {
                $status = 'Diterima/Diverifikasi';
            }

            return Redirect::back()->withErrors(['msg' => 'Mohon maaf, status Jadwal Dinas Anda telah '.$status.' oleh Kepegawaian']);
        } else {
            $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
            $detail = jadwal_detail::join('users','users.id','=','kepegawaian_jadwal_detail.pegawai_id')
                        ->where('kepegawaian_jadwal_detail.id_jadwal',$id)
                        ->select('kepegawaian_jadwal_detail.*','users.nama as nama_pegawai')
                        ->get();
            $ref_shift = ref_jadwal_shift::where('pegawai_id',Auth::user()->id)->get();
            $ref_users = ref_jadwal_users::where('pegawai_id',Auth::user()->id)->first();
            $jml_tgl = Carbon::create($jadwal->tahun, $jadwal->bulan)->format('t');
            // print_r($detail);
            // die();
            $data = [
                // 'show' => $show,
                'jadwal' => $jadwal,
                'detail' => $detail,
                'ref_shift' => $ref_shift,
                'ref_users' => $ref_users,
                'users' => $users,
                'jml_tgl' => $jml_tgl,
            ];

            return view('pages.kepegawaian.jadwal.user.ubah')->with('list', $data);
        }
    }

    function prosesTambah(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $getJadwal = jadwal::where('id',$request->id_jadwal)->first();
        $totalDay = Carbon::create($getJadwal->tahun, $getJadwal->bulan)->format('t');

        for ($i=0; $i < count($request->id_staf) ; $i++) {
            $data = new jadwal_detail;
            $data->id_jadwal = $request->id_jadwal;
            $data->pegawai_id = $request->id_staf[$i];
            $data->pegawai_nama = $request->nama_staf[$i];
            for ($t = 1; $t <= $totalDay; $t++) {
                $hit = 'tgl'.$t;
                $data->$hit = strtoupper($request->$hit[$i]);
            }
            $data->save();
        }

        datalogs::record($getJadwal->pegawai_id, 'Baru saja melakukan penambahan Jadwal Dinas Pegawai Bulan '.$getJadwal->bulan.' Tahun '.$getJadwal->tahun, $getJadwal->staf, null, $getJadwal, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return redirect()->route('kepegawaian.jadwaldinas.index')->with('message','Jadwal Dinas Karyawan berhasil disimpan pada '.$tgl);
    }

    function prosesUbah(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $getJadwal = jadwal::where('id',$request->id_jadwal)->first();
        $totalDay = Carbon::create($getJadwal->tahun, $getJadwal->bulan)->format('t');
        $getData = jadwal_detail::where('id_jadwal',$request->id_jadwal)->get();

        $data = jadwal_detail::where('id_jadwal',$request->id_jadwal)->get();
        for ($i=0; $i < count($getData) ; $i++) {
            for ($t = 1; $t <= $totalDay; $t++) {
                $hit = 'tgl'.$t;
                $data[$i]->$hit = strtoupper($request->$hit[$i]);
            }
            $data[$i]->save();
        }

        datalogs::record($getJadwal->pegawai_id, 'Baru saja melakukan perubahan Jadwal Dinas Pegawai Bulan '.$getJadwal->bulan.' Tahun '.$getJadwal->tahun, $getJadwal->staf, null, $getJadwal, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return redirect()->route('kepegawaian.jadwaldinas.index')->with('message','Perubahan Jadwal Dinas Karyawan berhasil dilakukan pada '.$tgl);
        // return Redirect::route()->with('message','Perubahan Jadwal Dinas Karyawan berhasil dilakukan pada '.$tgl);
    }

    // AJAX JSON ---------------------------------------------------------------------------------------------

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
                $getData = jadwal::where('pegawai_id',$request->pegawai)->where('progress',1)->orderBy('updated_at','desc')->first();
                if ($getData != null) {
                    return Response::json(array(
                        'message' => 'Masih terdapat pengajuan Jadwal Dinas yang berstatus <b><u>Pending</u></b>, silakan konfirmasi Bagian Kepegawaian! ',
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
                    datalogs::record($request->pegawai, 'Baru saja mengajukan penambahan Jadwal Dinas Pegawai Bulan '.$bulan.' Tahun '.$tahun, $getData->staf, null, $data, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');
                    return Response::json(array(
                        'message' => $getData,
                        'code' => 200,
                    ));
                }

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

    function getShift($id,$user)
    {
        $shift = ref_jadwal_shift::where('pegawai_id',$user)->get();
        $jadwal = jadwal::where('id',$id)->first();
        $totalDay = Carbon::create($jadwal->tahun, $jadwal->bulan)->format('t');

        for($i = 0; $i < count($shift); $i++)
        {
            $shiftArr[] = $shift[$i]->singkat;
        }

        $data = [
            'shift' => $shift,
            'shiftArr' => $shiftArr,
            'jadwal' => $jadwal,
            'totalDay' => $totalDay,
        ];

        return response()->json($data, 200);
    }

    // TAMPIL JADWAL
    function jadwal($id)
    {
        $detail = jadwal_detail::where('id_jadwal',$id)->get();
        $jadwal  = jadwal::join('users','users.id','=','kepegawaian_jadwal.pegawai_id')
                ->select('kepegawaian_jadwal.*','users.nama as nama_pegawai')
                ->where('kepegawaian_jadwal.id',$id)
                ->first();
        $totalDay = Carbon::create($jadwal->tahun, $jadwal->bulan)->format('t');
        for($i = 1; $i <= $totalDay; $i++)
        {
            $dataArray[] = Carbon::create($jadwal->tahun, $jadwal->bulan, $i)->dayName;
        }
        $getBulan = ['','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        foreach ($getBulan as $key => $value) {
            if ($key == $jadwal->bulan) {
                $bulan = $value;
            }
        }

        $data = [
            'bulan' => $bulan,
            'detail' => $detail,
            'jadwal' => $jadwal,
            'totalDay' => $totalDay,
            'dataArray' => $dataArray,
        ];

        return response()->json($data, 200);
    }

    // TABEL RIWAYAT JADWAL
    function table($id)
    {
        $users  = users::select('id','nama')->where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = jadwal::join('users','users.id','=','kepegawaian_jadwal.pegawai_id')
                ->select('kepegawaian_jadwal.*','users.nama as nama_pegawai')
                ->where('kepegawaian_jadwal.pegawai_id',$id)
                ->get();

        $data = [
            'users' => $users,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $jadwal = jadwal::find($id);

        // Delete
        $jadwal->delete();
        $detail = jadwal_detail::where('id_jadwal',$id)->delete();

        return response()->json($tgl, 200);
    }
}
