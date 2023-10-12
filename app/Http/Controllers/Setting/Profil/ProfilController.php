<?php

namespace App\Http\Controllers\Setting\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\users_foto;
use App\Models\users;
use App\Models\logs;
use App\Models\alamat;
use App\Models\model_has_roles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;
use Redirect;

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
        $show  = users::where('id','=', $id)->first();
        $foto = DB::table('users_foto')->where('user_id', '=', $id)->first();
        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->select('model_has_roles.model_id as id_user','roles.name as nama_role')->get();

        $data = [
            'id_user' => $id,
            'showlog' => $showlog,
            'user' => $user,
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
        //
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
        //
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
}
