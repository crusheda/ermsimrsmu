<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\users;
use App\Models\users_foto;
use App\Models\logs;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class ProfilKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show  = users::where('nik','!=',null)->get();
        $showMin  = users::where('nik',null)->get();

        $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name as nama_role', 'users.id as id_user')
            ->get();

        $data = [
            'show' => $show,
            'showMin' => $showMin,
            'role' => $role,
        ];

        return view('pages.profilkaryawan.index')->with('list', $data);
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
        $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name')
            ->where('users.id',$id)
            ->get();

        $show  = users::where('id','=', $id)->first();

        $foto = users_foto::where('user_id', '=', $id)->first();

        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();

        $data = [
            'id_user' => $id,
            'role' => $role,
            'show' => $show,
            'foto' => $foto,
        ];

        return view('pages.profilkaryawan.show')->with('list', $data);
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
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = users::find($id);
        $data->delete();

        return Redirect::back()->with('message','Anda berhasil menonaktifkan Karyawan pada '.$tgl);
    }
}
