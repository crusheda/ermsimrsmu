<?php

namespace App\Http\Controllers\Perbaikan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\perbaikan_it;
use App\Models\perbaikan_it_lampiran;
use App\Models\users;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class itController extends Controller
{
    function index()
    {
        $show = perbaikan_it::get();

        $data = [
            'show' => $show,
        ];

        return view('pages.perbaikan.it.index-user')->with('list', $data);
    }
}
