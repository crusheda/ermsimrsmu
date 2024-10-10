<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\kepegawaian\pd;
use App\Models\kepegawaian\pd_ceklis;
use Illuminate\Http\Request;

class PDController extends Controller
{
    function index()
    {
        $users  = users::where('nik','!=',null)->where('nama','!=',null)->orderBy('nama', 'asc')->get();
        $show  = pd::get();

        // $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //     ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //     ->select('roles.name as nama_role', 'users.id as id_user')
        //     ->get();

        $data = [
            'show' => $show,
            'users' => $users,
            // 'role' => $role,
        ];

        return view('pages.kepegawaian.pd.index')->with('list', $data);
    }
}
