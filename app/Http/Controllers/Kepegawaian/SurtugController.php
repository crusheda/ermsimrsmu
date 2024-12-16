<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\kepegawaian\surtug;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File;

class SurtugController extends Controller
{
    function index()
    {
        // if (Auth::user()->getPermission('admin_kepegawaian') == true) {
        //     return view('pages.kepegawaian.idcard.index-admin');
        // } else {
        //     $id_user = Auth::user()->id;
        //     $user  = users::where('id',$id_user)->first();

        //     $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //         ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //         ->select('roles.name as nama_role','roles.deskripsi as nama_role2', 'users.id as id_user')
        //         ->where('users.id',$id_user)
        //         ->first();

        //     $data = [
        //         'user' => $user,
        //         'role' => $role,
        //     ];

        //     return view('pages.kepegawaian.idcard.index-user')->with('list', $data);
        // }
        $id_user = Auth::user()->id;
        $user  = users::where('id',$id_user)->first();
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();

        $show = surtug::get();

        $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name as nama_role','roles.deskripsi as nama_role2', 'users.id as id_user')
            ->where('users.id',$id_user)
            ->first();

        $data = [
            'show' => $show,
            'user' => $user,
            'users' => $users,
            'role' => $role,
        ];

        return view('pages.kepegawaian.surtug.index')->with('list', $data);
    }

    function tableAdminSurtug()
    {
        $show = surtug::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data);
    }

    function tableUserSurtug($id)
    {
        $show = surtug::where('id',$id)->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data);
    }
}
