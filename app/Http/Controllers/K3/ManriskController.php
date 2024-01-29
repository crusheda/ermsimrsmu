<?php

namespace App\Http\Controllers\K3;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Models\k3_manrisk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use Auth;
use Validator,Redirect,Response,File;

class ManriskController extends Controller
{
    function index()
    {
        $show = k3_manrisk::get();

        $data = [
            'show' => $show,
        ];

        return view('pages.k3.manrisk.index')->with('list',$data);
    }
}
