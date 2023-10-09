<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Models\roles;
use App\Models\model_has_roles;
use App\Models\struktur_organisasi;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class StrukturOrganisasiController extends Controller
{
    function index()
    {
        $user  = users::where('status',null)->get();
        $roles  = roles::get();
        $struktur_organisasi  = struktur_organisasi::get();

        $data = [
            'user' => $user,
            'roles' => $roles,
            'struktur_organisasi' => $struktur_organisasi,
        ];

        return view('pages.strukturorganisasi.index')->with('list', $data);
    }

    function create()
    {
        $user  = users::where('status',null)->get();
        $role  = roles::get();

        $data = [
            'user' => $user,
            'role' => $role,
        ];

        return view('pages.strukturorganisasi.tambah')->with('list', $data);
    }

    function store(Request $request)
    {
        $getUser  = users::where('id',$request->user)->first();
        $getRoleUser  = model_has_roles::where('model_id',$getUser->id)->get();

        foreach ($getRoleUser as $key => $value) {
            $roleUser[] = strval($value->role_id);
        }

        $data = new struktur_organisasi;
        $data->id_user = $getUser->id;
        $data->nama_user = $getUser->nama.' ('.$getUser->name.')';
        $data->role = json_encode($roleUser);
        // $data->bawahan = $request->bawahan;
        $data->bawahan = json_encode($request->bawahan);
        // dd($data);
        // print_r($data);
        // die();
        $data->save();

        return redirect()->route('strukturorganisasi.index')->with('message','Tambah Bawahan Struktur '.$getUser->nama.' Berhasil');
    }
}
