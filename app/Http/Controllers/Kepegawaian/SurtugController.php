<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\kepegawaian\surtug;
use App\Models\kepegawaian\surtug_ceklis;
use Illuminate\Http\Request;

class SurtugController extends Controller
{
    function index()
    {
        // $users  = users::where('nik','!=',null)->orderBy('nama', 'asc')->get();
        // $show  = idcard::get();

        // $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //     ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //     ->select('roles.name as nama_role', 'users.id as id_user')
        //     ->get();

        // $data = [
        //     'show' => $show,
        //     'showmin' => $showMin,
        //     'role' => $role,
        // ];

        return view('pages.kepegawaian.surtug.index');
        // return view('pages.profilkaryawan.index')->with('list', $data);
    }
}
