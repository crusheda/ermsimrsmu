<?php

namespace App\Http\Controllers\Inventaris\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\aset;
use App\Models\aset_ruangan;
use App\Models\aset_mutasi;
use App\Models\aset_peminjaman;
use App\Models\aset_pengembalian;
use App\Models\aset_penarikan;
use App\Models\aset_pemeliharaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use \PDF;

class AsetController extends Controller
{
    function index()
    {
        return view('pages.inventaris.aset.index');
    }
}
