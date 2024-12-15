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
