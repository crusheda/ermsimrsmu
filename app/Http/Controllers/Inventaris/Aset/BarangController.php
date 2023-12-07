<?php

namespace App\Http\Controllers\Inventaris\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
// use App\Models\users;
// use App\Models\pengadaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use \PDF;

class BarangController extends Controller
{
    function index()
    {
        return view('pages.inventaris.aset.index');
    }
}
