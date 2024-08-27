<?php

namespace App\Http\Controllers\Setting\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\users_foto;
use App\Models\referensi;
use App\Models\users_doc;
use App\Models\users;
use App\Models\logs;
use App\Models\alamat;
use App\Models\model_has_roles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator, Auth, Storage, Exception, Redirect;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user  = Auth::user();
        $id    = $user->id;
        $show  = DB::table('users')->where('id','=', $id)->first();
        $foto = DB::table('users_foto')->where('user_id', '=', $id)->first();
        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->select('model_has_roles.model_id as id_user','roles.name as nama_role')->get();
        $provinsi = alamat::select('provinsi')->groupBy('provinsi')->get();
        $kota = alamat::select('nama_kabkota')->groupBy('nama_kabkota')->get();
        $ref_dokumen = referensi::where('ref_jenis',8)->get();

        $data = [
            'id_user' => $id,
            'showlog' => $showlog,
            'user' => $user,
            'show' => $show,
            'foto' => $foto,
            'role' => $role,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'ref_dokumen' => $ref_dokumen,
        ];

        return view('pages.setting.profil.index')->with('list', $data);
    }

    // public function index2() // OLD
    // {
    //     $user  = Auth::user();
    //     $id    = $user->id;
    //     $show  = DB::table('users')->where('id','=', $id)->first();
    //     $foto = DB::table('users_foto')->where('user_id', '=', $id)->first();
    //     $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();
    //     $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->select('model_has_roles.model_id as id_user','roles.name as nama_role')->get();
    //     $provinsi = alamat::select('provinsi')->groupBy('provinsi')->get();
    //     $kota = alamat::select('nama_kabkota')->groupBy('nama_kabkota')->get();

    //     $data = [
    //         'id_user' => $id,
    //         'showlog' => $showlog,
    //         'user' => $user,
    //         'show' => $show,
    //         'foto' => $foto,
    //         'role' => $role,
    //         'provinsi' => $provinsi,
    //         'kota' => $kota,
    //     ];

    //     return view('pages.setting.profil.index2')->with('list', $data);
    // }

    function indexKepegawaian($id)
    {
        $show  = DB::table('users')->where('id','=', $id)->first();
        $foto = DB::table('users_foto')->where('user_id', '=', $id)->first();
        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->select('model_has_roles.model_id as id_user','roles.name as nama_role')->get();

        $data = [
            'id_user' => $id,
            'showlog' => $showlog,
            'show' => $show,
            'foto' => $foto,
            'role' => $role,
        ];

        return view('pages.setting.profil.index')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user  = Auth::user();
        $id    = $user->id;
        $name  = $user->name;
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $now = Carbon::now();

        // Ubah data Kepegawaian Table 'users'
        $data = users::find($id);
        $data->nik = $request->nik;
        $data->nama = $request->nama;
        $data->nick = $request->nick;
        $data->temp_lahir = $request->temp_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jns_kelamin = $request->jns_kelamin;
        $data->status_kawin = $request->status_kawin;
        $data->email = $request->email;
        $data->no_hp = $request->no_hp;
        $data->ig = $request->ig;
        $data->fb = $request->fb;

            // ALAMAT KTP
            $data->alamat_ktp = $request->alamat_ktp;
            if (empty($data->ktp_provinsi)) {
                $data->ktp_provinsi = $request->ktp_provinsi;
            } else {
                if ($request->ktp_provinsi == null) {
                } else {
                    $data->ktp_provinsi = $request->ktp_provinsi;
                }
            }
            if (empty($data->ktp_kabupaten)) {
                $data->ktp_kabupaten = $request->ktp_kabupaten;
            } else {
                if ($request->ktp_kabupaten == null) {
                } else {
                    $data->ktp_kabupaten = $request->ktp_kabupaten;
                }
            }
            if (empty($data->ktp_kecamatan)) {
                $data->ktp_kecamatan = $request->ktp_kecamatan;
            } else {
                if ($request->ktp_kecamatan == null) {
                } else {
                    $data->ktp_kecamatan = $request->ktp_kecamatan;
                }
            }
            if (empty($data->ktp_kelurahan)) {
                $data->ktp_kelurahan = $request->ktp_kelurahan;
            } else {
                if ($request->ktp_kelurahan == null) {
                } else {
                    $data->ktp_kelurahan = $request->ktp_kelurahan;
                }
            }

            // ALAMAT DOMISILI
            if ($request->cek_dom == '0') {
                $data->dom_provinsi = null;
                $data->dom_kabupaten = null;
                $data->dom_kecamatan = null;
                $data->dom_kelurahan = null;
                $data->alamat_dom = null;
            } else {
                $data->alamat_dom = $request->alamat_dom;
                if (empty($data->dom_provinsi)) {
                    $data->dom_provinsi = $request->dom_provinsi;
                } else {
                    if ($request->dom_provinsi == null) {
                    } else {
                        $data->dom_provinsi = $request->dom_provinsi;
                    }
                }
                if (empty($data->dom_kabupaten)) {
                    $data->dom_kabupaten = $request->dom_kabupaten;
                } else {
                    if ($request->dom_kabupaten == null) {
                    } else {
                        $data->dom_kabupaten = $request->dom_kabupaten;
                    }
                }
                if (empty($data->dom_kecamatan)) {
                    $data->dom_kecamatan = $request->dom_kecamatan;
                } else {
                    if ($request->dom_kecamatan == null) {
                    } else {
                        $data->dom_kecamatan = $request->dom_kecamatan;
                    }
                }
                if (empty($data->dom_kelurahan)) {
                    $data->dom_kelurahan = $request->dom_kelurahan;
                } else {
                    if ($request->dom_kelurahan == null) {
                    } else {
                        $data->dom_kelurahan = $request->dom_kelurahan;
                    }
                }
            }

            $data->sd = $request->sd;
            $data->smp = $request->smp;
            $data->sma = $request->sma;
            $data->d1 = $request->d1;
            $data->d3 = $request->d3;
            $data->d4 = $request->d4;
            $data->s1 = $request->s1;
            $data->s2 = $request->s2;
            $data->s3 = $request->s3;

            if (empty($data->th_sd)) {
                $data->th_sd = $request->th_sd;
            } else {
                if ($request->th_sd == null) {
                } else {
                    $data->th_sd = $request->th_sd;
                }
            }
            if (empty($data->th_smp)) {
                $data->th_smp = $request->th_smp;
            } else {
                if ($request->th_smp == null) {
                } else {
                    $data->th_smp = $request->th_smp;
                }
            }
            if (empty($data->th_sma)) {
                $data->th_sma = $request->th_sma;
            } else {
                if ($request->th_sma == null) {
                } else {
                    $data->th_sma = $request->th_sma;
                }
            }
            if (empty($data->th_d1)) {
                $data->th_d1 = $request->th_d1;
            } else {
                if ($request->th_d1 == null) {
                } else {
                    $data->th_d1 = $request->th_d1;
                }
            }
            if (empty($data->th_d3)) {
                $data->th_d3 = $request->th_d3;
            } else {
                if ($request->th_d3 == null) {
                } else {
                    $data->th_d3 = $request->th_d3;
                }
            }
            if (empty($data->th_d4)) {
                $data->th_d4 = $request->th_d4;
            } else {
                if ($request->th_d4 == null) {
                } else {
                    $data->th_d4 = $request->th_d4;
                }
            }
            if (empty($data->th_s1)) {
                $data->th_s1 = $request->th_s1;
            } else {
                if ($request->th_s1 == null) {
                } else {
                    $data->th_s1 = $request->th_s1;
                }
            }
            if (empty($data->th_s2)) {
                $data->th_s2 = $request->th_s2;
            } else {
                if ($request->th_s2 == null) {
                } else {
                    $data->th_s2 = $request->th_s2;
                }
            }
            if (empty($data->th_s3)) {
                $data->th_s3 = $request->th_s3;
            } else {
                if ($request->th_s3 == null) {
                } else {
                    $data->th_s3 = $request->th_s3;
                }
            }

        $data->pengalaman_kerja = $request->pengalaman_kerja;

        $data->riwayat_penyakit = $request->riwayat_penyakit;
        $data->riwayat_penyakit_keluarga = $request->riwayat_penyakit_keluarga;
        $data->riwayat_operasi = $request->riwayat_operasi;
        $data->riwayat_penggunaan_obat = $request->riwayat_penggunaan_obat;

        $data->save();

        return redirect()->route('profil.index')->with('message','Ubah Data Profil Anda Berhasil Pada '.$tgl);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show  = users::where('id','=', $id)->first();

        $foto = DB::table('users_foto')->where('user_id', '=', $id)->first();

        $provinsi = alamat::select('provinsi')->groupBy('provinsi')->get();
        $kota = alamat::select('nama_kabkota')->groupBy('nama_kabkota')->get();

        $data = [
            'show' => $show,
            'foto' => $foto,
            'provinsi' => $provinsi,
            'kota' => $kota,
        ];

        return view('pages.setting.profil.ubah')->with('list', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // API
    public function storeImg(Request $request, $id)
    {
        $this->validate($request,[
            'file' => 'nullable|file|max:50000', // MAX 50 Mb
            ]);

        $now = Carbon::now();

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');
        // print_r($uploadedFile);
        // die();
        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        if ($uploadedFile == '') {
            return redirect()->back()->with('message','Upload Foto Gagal, tidak ada foto yang dimasukkan.');
        }else {
            $path = $uploadedFile->store('public/files/foto_profil');
            $title = $request->title ?? $uploadedFile->getClientOriginalName();
            // print_r($uploadedFile);
            // die();
            $save = Storage::disk('image')->put('', $uploadedFile);
        }
        // print_r($save);
        // die();
        $user  = Auth::user();
        $id    = $user->id;
        $name  = $user->name;

        $query = users_foto::where('user_id', $id)->first();
        $getUser = users::where('id',$id)->first();

        // $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->where('model_has_roles.model_id', $id)->get();
        $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('roles.name as nama_role', 'users.id as id_user')
                ->where('users.id', $id)
                ->get();

        // print_r($role);
        // die();
        foreach ($role as $key => $value) {
            $unit[] = $value->nama_role;
        }

        // Save to Foto Profil
        if ($query == null) {
            $data = new users_foto;
            $data->user_id = $id;
            $data->name = $name;
            $data->unit = json_encode($unit);

                $data->title = $title;
                $data->filename = $path;

            $data->created_at = $now;
            $data->save();
        } else {
            $data = users_foto::find($query->id);
            $data->user_id = $id;
            $data->name = $name;
            $data->unit = json_encode($unit);

                $data->title = $title;
                $data->filename = $path;

            $data->updated_at = $now;
            $data->save();
        }

        return redirect()->back()->with('message','Ubah Foto Profil Berhasil');
    }

    function storeBlobImg(Request $request)
    {
        $data = base64_decode($request->croppedImage);
        print_r($request->croppedImage);
        print_r($data);
        die();

        file_put_contents('test.png', $data);
        // print_r($request->all());
        // die();
    }

    public function apiProvinsi($id)
    {
        $data = DB::table('alamat')
                ->select('nama_kabkota')
                ->where('provinsi', $id)
                ->groupBy('nama_kabkota')
                ->get();

        return response()->json($data, 200);
    }

    public function apiKota($id)
    {
        $data = DB::table('alamat')
                ->select('kecamatan')
                ->where('nama_kabkota', $id)
                ->groupBy('kecamatan')
                ->get();

        return response()->json($data, 200);
    }

    public function apiKecamatan($id)
    {
        $data = DB::table('alamat')
                ->select('desa')
                ->where('kecamatan', $id)
                ->groupBy('desa')
                ->get();

        return response()->json($data, 200);
    }

    // DOKUMEN
    function tableDokumen($id)
    {
        $show  = users_doc::join('referensi','referensi.id','=','users_doc.ref_id')
                ->where('users_doc.user_id', $id)
                ->where('users_doc.deleted_at',null)
                ->where('users_doc.status',true)
                ->select('referensi.deskripsi as nama_ref','users_doc.*')
                ->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function tambahDokumen(Request $request)
    {
        $carbon = Carbon::now();
        // $tgl = $carbon->isoFormat('dddd, D MMMM Y, HH:mm a');

        $validator = Validator::make($request->all(), [
            'file' => 'max:5000', // required -- mimes:jpg,png,jpeg
        ]);

        // print_r($request->jns);
        // die();
        if ($validator->fails()) {
            $arr = json_encode($validator->errors());
            return redirect()->back()->with('error',$arr);
        } else {
            $data = new users_doc;
            $data->ref_id = $request->jenis;
            $data->user_id = $request->user_id;
            $data->tgl_mulai = $request->tgl_mulai;
            $data->tgl_akhir = $request->tgl_akhir;
            $data->no_surat = $request->no_surat;
            $data->deskripsi = $request->deskripsi;
            $data->status = true;

            $file_upload = $request->file('file');
            if ($request->hasFile('file')) {
                // saving file
                $array_filename = $file_upload->store('public/files/profil/dokumen/'.$request->user_id);
                $array_title = $file_upload->getClientOriginalName();
                // encode file
                $data->filename = json_encode($array_filename);
                $data->title = json_encode($array_title);
            }

            $data->save();

            return response()->json($file_upload->getClientOriginalName(), 200);
        }
    }

    function downloadDokumen($id)
    {
        $data = users_doc::find($id);
        return Storage::download($data->filename, $data->title);
    }
}
