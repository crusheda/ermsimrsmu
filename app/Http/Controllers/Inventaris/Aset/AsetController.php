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
use Validator,Redirect,Response,File;

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

    function store(Request $request)
    {
        $carbon = Carbon::now();
        $tgl = $carbon->isoFormat('dddd, D MMMM Y, HH:mm a');
        $month = $carbon->isoFormat('MM');
        $year = $carbon->isoFormat('YYYY');
        $validator = Validator::make($request->all(), [
            'file' => ['max:10000','mimes:jpeg,jpg,png'],
        ]);

        if ($validator->fails()) {
            $error = 'File tidak sesuai ketentuan!';
            return response()->json($error, 400);
        } else {
            $getRuangan = aset_ruangan::where('id',$request->ruangan)->first();
            $getUrutan = aset::orderBy('created_at','desc')->first();
            if (!empty($getUrutan)) {
                $urutan = $getUrutan->urutan + 1;
            } else {
                $urutan = '1';
            }

            $data = new aset;
            $data->urutan = $urutan;
            $data->id_user_aset = $request->id_user_aset;
            $data->id_ruangan = $request->id_ruangan;
            $data->jenis = $request->jenis;
            $data->kalibrasi = $request->kalibrasi;
            $data->no_kalibrasi = $request->no_kalibrasi;
            $data->tgl_berlaku = $request->tgl_berlaku;
            $data->tgl_perolehan = $request->tgl_perolehan;
            $data->no_inventaris = '00.03.27.'.$getRuangan->kode.'.'.$request->jenis.'.'.$urutan.'.'.$month.'.'.$year;
            $data->sarana = $request->sarana;
            $data->merk = $request->merk;
            $data->tipe = $request->tipe;
            $data->no_seri = $request->no_seri;
            $data->tgl_operasi = $request->tgl_operasi;
            $data->asal_perolehan = $request->asal_perolehan;
            $data->nilai_perolehan = $request->nilai_perolehan;
            $data->kondisi = $request->kondisi;
            $data->golongan = $request->golongan;
            $data->umur = $request->umur;
            $data->tarif = $request->tarif;
            $data->penyusutan = $request->penyusutan;
            $data->tgl_input = $tgl;

            $file_upload = $request->file('file');
            if ($request->hasFile('file')) {
                foreach ($file_upload as $file) {
                    // $request->validate([
                    //     'file' => ['max:10000','mimes:jpeg,jpg,png'],
                    // ]);
                    $array_filename[] = $file->store('public/files/inventaris/aset/sarana/'.$request->ruangan);
                    $array_title[] = $file->getClientOriginalName();
                }
            }
            $data->filename = json_encode($array_filename);
            $data->title = json_encode($array_title);

            // $request->validate([
            //     'file' => ['max:10000','mimes:jpg'],
            // ]);
            // if ($request->file('file') && $request->file('file')->isValid()) {
            //     $data->filename = $request->file('file')->store('public/files/inventaris/aset/sarana');
            //     $data->title = $request->file('file')->getClientOriginalName();
            // }

            $data->save();

            return response()->json($tgl, 200);
        }
    }
}
