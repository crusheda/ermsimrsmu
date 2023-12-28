<?php

namespace App\Http\Controllers\Inventaris\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsetScanController extends Controller
{
    function index()
    {
        return view('pages.inventaris.aset.scan.index');
    }
}
