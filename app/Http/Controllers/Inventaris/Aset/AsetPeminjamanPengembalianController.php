<?php

namespace App\Http\Controllers\Inventaris\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Models\aset;
use App\Models\aset_peminjaman;
use App\Models\aset_pengembalian;
use App\Models\aset_penarikan;
use App\Models\aset_ruangan;
use App\Models\roles;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use Auth;
use \PDF;
use Validator,Redirect,Response,File;

class AsetPeminjamanPengembalianController extends Controller
{
    function getPeminjamanAset($id)
    {
        $validasi1 = aset_penarikan::where('id_aset',$id)->orderBy('created_at','desc')->first();
        $validasi2 = aset_peminjaman::where('id_aset',$id)->where('status',true)->orderBy('created_at','desc')->first();
        $ruangan = aset_ruangan::get();
        $show = aset::join('aset_ruangan','aset_ruangan.id','=','aset.id_ruangan')
                    // ->join('aset_penarikan','aset_penarikan.id_aset','=','aset.id')
                    ->select('aset_ruangan.ruangan','aset_ruangan.lokasi','aset.*')
                    ->where('aset.id',$id)
                    ->first();

        $data = [
            'penarikan' => $validasi1,
            'peminjaman' => $validasi2,
            'ruangan' => $ruangan,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function getPengembalianAset($id)
    {
        $validasi1 = aset_penarikan::where('id_aset',$id)->orderBy('created_at','desc')->first();
        $validasi2 = aset_peminjaman::where('id_aset',$id)->where('status',true)->orderBy('created_at','desc')->first();
        $validasi3 = aset_pengembalian::where('id_aset',$id)->orderBy('created_at','desc')->first();
        $ruangan = aset_ruangan::get();
        $show = aset::join('aset_ruangan','aset_ruangan.id','=','aset.id_ruangan')
                    // ->join('aset_penarikan','aset_penarikan.id_aset','=','aset.id')
                    ->select('aset_ruangan.ruangan','aset_ruangan.lokasi','aset.*')
                    ->where('aset.id',$id)
                    ->first();

        $data = [
            'penarikan' => $validasi1,
            'peminjaman' => $validasi2,
            'pengembalian' => $validasi3,
            'ruangan' => $ruangan,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }
}
