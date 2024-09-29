<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\kepegawaian\idcard;
use Illuminate\Http\Request;

class IDCardController extends Controller
{
    function index()
    {
        $users  = users::where('nik','!=',null)->orderBy('nama', 'asc')->get();

        $role = users::Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name as nama_role', 'users.id as id_user')
            ->get();

        $data = [
            'users' => $users,
            'role' => $role,
        ];

        return view('pages.kepegawaian.idcard.index-user')->with('list', $data);
    }

    // USER

    // ADMIN
    function indexAdmin()
    {
        $show  = idcard::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    // BOTH
}
