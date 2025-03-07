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
use App\Models\struktur_organisasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File,Storage;

class JadwalController extends Controller
{
    function index()
    {
        if (Auth::user()->getPermission('admin_kepegawaian') == true) {
            return view('pages.kepegawaian.jadwal.index-admin');
        } else {
            $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
            $data = [
                // 'show' => $show,
                'users' => $users,
            ];
            return view('pages.kepegawaian.jadwal.index-user')->with('list', $data);
        }
    }

    function indexBawahan()
    {
        $jabatan = struktur_organisasi::where('id_user',Auth::user()->id)->orderBy('updated_at','desc')->first();
        if ($jabatan) {
            $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
            $data = [
                // 'show' => $show,
                'users' => $users,
            ];
            return view('pages.kepegawaian.jadwal.index-bawahan')->with('list', $data);
        } else {
            return redirect()->back()->withErrors("Pengguna tidak memiliki akses verifikasi / tidak mempunyai bawahan");
        }
    }

    function indexShift()
    {
        return view('pages.kepegawaian.jadwal.ref.shift');
    }

    function indexStaf()
    {
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $data = [
            // 'show' => $show,
            'users' => $users,
        ];
        return view('pages.kepegawaian.jadwal.ref.staf')->with('list', $data);
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
        if ($jadwal->progress == 0 || $jadwal->progress == 3) {
            if ($jadwal->progress == 0) {
                $status = 'Ditolak';
            } else {
                $status = 'Divalidasi';
            }

            return Redirect::back()->withErrors(['msg' => 'Mohon maaf, status Jadwal Dinas Anda telah '.$status]);
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
                // Get Reference
                $now = Carbon::now();
                // Init
                $tgl = $now->isoFormat('DD');
                $bulan = Carbon::parse($request->tgl)->isoFormat('MM');
                $tahun = Carbon::parse($request->tgl)->isoFormat('YYYY');
                // $getData = jadwal::where('pegawai_id',$request->pegawai)->whereIn('progress',[1,2,3])->orderBy('updated_at','desc')->first();
                $getData = jadwal::where('pegawai_id',$request->pegawai)
                                    ->where('bulan',$bulan)
                                    ->where('tahun',$tahun)
                                    ->whereIn('progress',[1,2,3])
                                    ->orderBy('updated_at','desc')
                                    ->first();
                // $submonth = $now->subMonth()->isoFormat('YYYY-MM');
                $thisDate = $now->isoFormat('YYYY-MM-DD');
                $setDate = Carbon::parse($tahun.'-'.$bulan.'-27')->isoFormat('YYYY-MM-DD');

                if ($thisDate <= $setDate) { // JIKA PENGAJUAN MELEBIHI TGL 27 PADA BULAN/TAHUN YANG DIPILIH
                    if ($getData != null) { // JIKA ADA PENGAJUAN YANG MASIH DALAM PROSES (PENDING/VERIFIKASI/VALIDASI)
                        return Response::json(array(
                            'message' => 'Masih terdapat proses pengajuan Jadwal Dinas yang belum diselesaikan, silakan konfirmasi Atasan Langsung/Bagian Kepegawaian atau hapus pengajuan sebelumnya <b>BILA PERLU</b>! ',
                            'code' => 500,
                        ));
                    } else {
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
                } else {
                    return Response::json(array(
                        'message' => 'Pengajuan Jadwal Dinas maksimal tanggal 27 setiap bulannya. Silakan pilih Bulan dan Tahun lainnya!',
                        'code' => 500,
                    ));
                }

            }
        }
    }

    function cekShift($id,$user)
    {
        if ($id == 'L' || $id == 'C') {
            return Response::json(array(
                'message' => $id,
                'code' => 200,
            ));
        } else {
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
    }

    function getShift($id,$user)
    {
        $shift = ref_jadwal_shift::where('pegawai_id',$user)->get();
        $jadwal = jadwal::join('users','users.id','=','kepegawaian_jadwal.pegawai_id')
                ->select('kepegawaian_jadwal.*','users.nama as nama_pegawai')
                ->where('kepegawaian_jadwal.id',$id)
                ->first();
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $totalDay = Carbon::create($jadwal->tahun, $jadwal->bulan)->format('t');

        for($i = 0; $i < count($shift); $i++)
        {
            $shiftArr[] = $shift[$i]->singkat;
        }

        $data = [
            'users' => $users,
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
        $shift  = ref_jadwal_shift::join('kepegawaian_jadwal','kepegawaian_jadwal.pegawai_id','=','referensi_jadwal_shift.pegawai_id')
                ->select('referensi_jadwal_shift.*')
                ->where('kepegawaian_jadwal.id',$id)
                ->get();
                // print_r($shift);
                // die();
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
            'shift' => $shift,
            'jadwal' => $jadwal,
            'totalDay' => $totalDay,
            'dataArray' => $dataArray,
        ];

        return response()->json($data, 200);
    }

    // TABEL RIWAYAT JADWAL
    function table($id)
    {
        $getStaf = ref_jadwal_users::get();
        $staf = null;
        foreach ($getStaf as $key => $value) {
            // print_r(json_decode($value->staf));
            // if ($value->pegawai_id == $id) {
            // }
            // $staf = $value->pegawai_id;
            if (in_array($id,json_decode($value->staf))) {
                $staf[] = $value->pegawai_id;
            }
        }
        if ($staf) {
            $staf = $staf;
        } else {
            $staf = '';
        }

        // print_r($staf);
        // die();
        $users  = users::select('id','nama')->where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = jadwal::join('users','users.id','=','kepegawaian_jadwal.pegawai_id')
                ->select('kepegawaian_jadwal.*','users.nama as nama_pegawai')
                ->where('kepegawaian_jadwal.pegawai_id',$staf)
                ->get();
        // print_r($show);
        // die();
        $data = [
            'users' => $users,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    // SHOW TABLE ADMIN
    function tableAll()
    {
        $users  = users::select('id','nama')->where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = jadwal::join('users','users.id','=','kepegawaian_jadwal.pegawai_id')
                ->select('kepegawaian_jadwal.*','users.nama as nama_pegawai')
                ->whereIn('kepegawaian_jadwal.progress',[1,2,3])
                ->get();

        $data = [
            'users' => $users,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    // SHOW TABLE ATASAN LANGSUNG
    function tableAllBawahan($user)
    {
        $jabatan = struktur_organisasi::where('id_user',$user)->orderBy('updated_at','desc')->first();
        $users  = users::select('id','nama')->where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = jadwal::join('users','users.id','=','kepegawaian_jadwal.pegawai_id')
                ->Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->select('kepegawaian_jadwal.*','users.nama as nama_pegawai')
                ->whereIn('model_has_roles.role_id',json_decode($jabatan->bawahan))
                // ->whereIn('kepegawaian_jadwal.progress',[0,1,2,3])
                ->get();

        $data = [
            'jabatan' => $jabatan,
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

    // ADMIN == PROSES VERIFIKASI DAN PENOLAKAN
    function verif($id,$user)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $jadwal = jadwal::find($id);

        // Change
        $jadwal->progress = 3;
        $jadwal->valid = $user;
        $jadwal->tgl_valid = Carbon::now();
        $jadwal->save();

        return response()->json($tgl, 200);
    }
    function batalVerif($id,$user)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $jadwal = jadwal::find($id);

        // Change
        $jadwal->progress = 2;
        $jadwal->valid = $user;
        $jadwal->tgl_valid = Carbon::now();
        $jadwal->save();

        return response()->json($tgl, 200);
    }
    // function tolak($id,$user)
    // {
    //     $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

    //     // Inisialisasi
    //     $jadwal = jadwal::find($id);

    //     // Change
    //     $jadwal->progress = 0;
    //     $jadwal->valid = $user;
    //     $jadwal->tgl_valid = Carbon::now();
    //     $jadwal->save();

    //     return response()->json($tgl, 200);
    // }
    // function batalTolak($id,$user)
    // {
    //     $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

    //     // Inisialisasi
    //     $jadwal = jadwal::find($id);

    //     // Change
    //     $jadwal->progress = 1;
    //     $jadwal->valid = $user;
    //     $jadwal->tgl_valid = Carbon::now();
    //     $jadwal->save();

    //     return response()->json($tgl, 200);
    // }

    // ATASAN LANGSUNG == PROSES VERIFIKASI DAN PENOLAKAN
    function verifBawahan($id,$user)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $jadwal = jadwal::find($id);

        // Change
        $jadwal->progress = 2;
        $jadwal->verif = $user;
        $jadwal->tgl_verif = Carbon::now();
        $jadwal->save();

        return response()->json($tgl, 200);
    }
    function batalVerifBawahan($id,$user)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $jadwal = jadwal::find($id);

        // Change
        $jadwal->progress = 1;
        $jadwal->verif = $user;
        $jadwal->tgl_verif = Carbon::now();
        $jadwal->save();

        return response()->json($tgl, 200);
    }
    function tolakBawahan($id,$user)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $jadwal = jadwal::find($id);

        // Change
        $jadwal->progress = 0;
        $jadwal->verif = $user;
        $jadwal->tgl_verif = Carbon::now();
        $jadwal->save();

        return response()->json($tgl, 200);
    }
    function batalTolakBawahan($id,$user)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $jadwal = jadwal::find($id);

        // Change
        $jadwal->progress = 1;
        $jadwal->verif = $user;
        $jadwal->tgl_verif = Carbon::now();
        $jadwal->save();

        return response()->json($tgl, 200);
    }

    // REFERENSI SHIFT -----------------------------------------------------------------------------------------------------------
    function tableShift($id)
    {
        $users  = users::select('id','nama')->where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = ref_jadwal_shift::join('users','users.id','=','referensi_jadwal_shift.pegawai_id')
                ->select('referensi_jadwal_shift.*','users.nama as nama_pegawai')
                ->where('referensi_jadwal_shift.pegawai_id',$id)
                ->get();

        $data = [
            'users' => $users,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function tambahShift(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $getDuplicate = ref_jadwal_shift::where('pegawai_id', $request->pegawai)->where('singkat',$request->singkat)->first();

        if (!empty($getDuplicate)) {
            return Response::json(array(
                'message' => 'Terdapat datarecord yang sama pada pengisian Nama Singkat Shift ('.$request->singkat.'), mohon ubah shift dengan penamaan lainnya!',
                'code' => 500,
            ));
        } else {
            $data = new ref_jadwal_shift;
            $data->pegawai_id = $request->pegawai;
            $data->singkat = $request->singkat;
            $data->shift = $request->shift;
            $data->berangkat = Carbon::parse($request->berangkat)->isoFormat('HH:mm');
            $data->pulang = Carbon::parse($request->pulang)->isoFormat('HH:mm');
            $data->ket = $request->ket;
            $data->save();
        }

        return response()->json($tgl);
    }

    function showUbahShift($id)
    {
        $show  = ref_jadwal_shift::join('users','users.id','=','referensi_jadwal_shift.pegawai_id')
                                ->select('referensi_jadwal_shift.*','users.nama as nama_pegawai')
                                ->where('referensi_jadwal_shift.id',$id)
                                ->first();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function ubahShift(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $getDuplicate = ref_jadwal_shift::where('pegawai_id', $request->pegawai)->where('singkat',$request->singkat)->count();

        if ($getDuplicate > 1) {
            return Response::json(array(
                'message' => 'Terdapat datarecord yang sama pada pengisian Nama Singkat Shift ('.$request->singkat.'), mohon tambahkan data shift lainnya!',
                'code' => 500,
            ));
        } else {
            $data = ref_jadwal_shift::find($request->id);
            $data->singkat = $request->singkat;
            $data->shift = $request->shift;
            $data->berangkat = Carbon::parse($request->berangkat)->isoFormat('HH:mm');
            $data->pulang = Carbon::parse($request->pulang)->isoFormat('HH:mm');
            $data->ket = $request->ket;
            $data->save();
        }

        return response()->json($tgl);
    }

    function hapusShift($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = ref_jadwal_shift::find($id);
        $data->delete();

        return response()->json($tgl, 200);
    }

    // REFERENSI STAFF -----------------------------------------------------------------------------------------------------------
    function tableStaf($id)
    {
        $users  = users::select('id','nama')->where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = ref_jadwal_users::join('users','users.id','=','referensi_jadwal_users.pegawai_id')
                ->select('referensi_jadwal_users.*','users.nama as nama_user')
                ->where('referensi_jadwal_users.pegawai_id',$id)
                ->get();

        $data = [
            'users' => $users,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function tambahStaf(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $getDuplicate = ref_jadwal_users::where('pegawai_id', $request->pegawai)->count();
        // printf($getDuplicate);
        // die();
        if ($getDuplicate > 0) {
            ref_jadwal_users::where('pegawai_id', $request->pegawai)->delete();
        }

        $data = new ref_jadwal_users;
        $data->pegawai_id = $request->pegawai;
        $data->staf = $request->staf;
        $data->save();

        return response()->json($tgl);
    }

    function showUbahStaf($id)
    {
        $users  = users::select('id','nama')->where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = ref_jadwal_users::where('id',$id)->first();

        $data = [
            'users' => $users,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function ubahStaf(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = ref_jadwal_users::find($request->id);
        $data->pegawai_id = $request->pegawai;
        $data->staf = $request->staf;
        $data->save();

        return response()->json($tgl);
    }

    function hapusStaf($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = ref_jadwal_users::find($id);
        $data->delete();

        return response()->json($tgl, 200);
    }
}
