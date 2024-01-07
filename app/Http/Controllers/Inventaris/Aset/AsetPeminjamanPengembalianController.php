<?php

namespace App\Http\Controllers\Inventaris\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Models\aset;
use App\Models\aset_peminjaman;
use App\Models\aset_pengembalian;
use App\Models\roles;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use Auth;
use \PDF;
use Validator,Redirect,Response,File;

class AsetPeminjamanPengembalianController extends Controller
{
    function getPeminjamanAset()
    {
        $show = aset::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function getPengembalianAset()
    {
        $show = aset::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }
}
