<?php

namespace App\Http\Controllers\Inventaris\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use App\Models\aset;
use App\Models\aset_ruangan;
use App\Models\aset_mutasi;
use App\Models\aset_penarikan;
use App\Models\roles;
use App\Models\users;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use Auth;
use \PDF;
use Validator,Redirect,Response,File;

class AsetMutasiController extends Controller
{
    function index($id) {
        $ruangan = aset_ruangan::get();
        $show = aset_mutasi::join('aset','aset.id','=','aset_mutasi.id_aset')
                    ->join('aset_ruangan as ara','ara.id','=','aset_mutasi.lokasi_awal')
                    ->join('aset_ruangan as art','art.id','=','aset_mutasi.lokasi_tujuan')
                    ->select('aset.sarana','aset_mutasi.*','ara.ruangan as ruangan_awal_aset','ara.lokasi as lokasi_awal_aset','art.ruangan as ruangan_tujuan_aset','art.lokasi as lokasi_tujuan_aset')
                    ->get();
                    // print_r($show);
                    // die();
        $aset = aset::join('aset_ruangan','aset_ruangan.id','=','aset.id_ruangan')
                    ->select('aset_ruangan.ruangan','aset_ruangan.lokasi','aset.*')
                    ->where('aset.id',$id)
                    ->first();
        $validasi_penarikan = aset_penarikan::where('id_aset',$id)->first();

        $data = [
            'ruangan' => $ruangan,
            'show' => $show,
            'aset' => $aset,
            'penarikan' => $validasi_penarikan,
        ];

        return response()->json($data, 200);
    }

    function store(Request $request) {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $aset = aset::where('id',$request->aset)->first();

            $data = new aset_mutasi;
            $data->id_aset = $request->aset;
            $data->id_user = $request->user;
            $data->lokasi_awal = $aset->id_ruangan;
            $data->lokasi_tujuan = $request->lokasi_tujuan;
            $data->ket = $request->ket;
            $data->kondisi = $request->kondisi;
            $data->kondisi_awal = $aset->kondisi;
            $data->save();

        $aset->id_ruangan = $request->lokasi_tujuan;
        $aset->kondisi = $request->kondisi;
        $aset->status = false;
        $aset->save();

        $reset = aset_penarikan::where('id_aset', $request->aset)->first();
        $reset->delete();

        return response()->json($tgl, 200);
    }

    function cariAsetDestroy($id){
        $data = aset_mutasi::where('id_aset', $id)->orderBy('id','desc')->first();

        return response()->json($data, 200);
    }

    function destroy($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = aset_mutasi::where('id', $id)->first();

            $aset = aset::where('id', $data->id_aset)->first();
            $aset->id_ruangan = $data->lokasi_awal;
            $aset->kondisi = $data->kondisi_awal;
            $aset->save();

        $data->delete();

        return response()->json($tgl, 200);
    }
}
