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
use App\Models\roles;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use \PDF;

class AsetController extends Controller
{
    function index()
    {
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
        $month = Carbon::now()->isoFormat('MM');
        $year = Carbon::now()->isoFormat('YYYY');
        $ruangan = aset_ruangan::get();

        $data = [
            'role' => $role,
            'month' => $month,
            'year' => $year,
            'ruangan' => $ruangan,
        ];

        return view('pages.inventaris.aset.index')->with('list',$data);
    }

    function getRuangan($id)
    {
        $query = aset_ruangan::where('id', $id)->first();

        return response()->json($query, 200);
    }

    function getLastAset()
    {
        $query = aset::orderBy('created_at','desc')->first();
        if (!empty($query)) {
            $data = $query->urutan + 1;
        } else {
            $data = '1';
        }

        return response()->json($data, 200);
    }
}
