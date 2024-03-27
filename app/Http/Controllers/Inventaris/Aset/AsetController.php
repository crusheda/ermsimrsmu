<?php

namespace App\Http\Controllers\Inventaris\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
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
use Storage;
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

    function detail($token)
    {
        $show = aset::join('aset_ruangan','aset.id_ruangan','=','aset_ruangan.id')
                ->where('aset.token',$token)
                ->first();

        $mutasi = aset_mutasi::join('aset','aset_mutasi.id_aset','=','aset.id')
                ->join('aset_ruangan','aset_mutasi.id_ruangan_mutasi','=','aset_ruangan.id')
                ->join('users','aset_mutasi.id_user_mutasi','=','users.id')
                ->join('users_foto','aset_mutasi.id_user_mutasi','=','users_foto.user_id')
                ->where('aset.token',$token)
                ->get();

        $peminjaman = aset_peminjaman::join('aset','aset_peminjaman.id_aset','=','aset.id')
                ->join('aset_ruangan','aset_peminjaman.id_ruangan_peminjaman','=','aset_ruangan.id')
                ->join('users','aset_peminjaman.id_user_peminjaman','=','users.id')
                ->join('users_foto','aset_peminjaman.id_user_peminjaman','=','users_foto.user_id')
                ->where('aset.token',$token)
                ->get();

        $pengembalian = aset_pengembalian::join('aset','aset_pengembalian.id_aset','=','aset.id')
                ->join('users','aset_pengembalian.id_user_pengembalian','=','users.id')
                ->join('users_foto','aset_pengembalian.id_user_pengembalian','=','users_foto.user_id')
                ->where('aset.token',$token)
                ->get();

        // Menentukan Kondisi
        if ($show->kondisi == 1) {
            $kondisi = 'Baik';
        } else {
            if ($show->kondisi == 2) {
                $kondisi = 'Cukup';
            } else {
                if ($show->kondisi == 3) {
                    $kondisi = 'Buruk';
                }
            }
        }

        // Menentukan Isi QR-Code
        $qr = $show->sarana.' | '.$show->merk.' | '.$show->tipe.' | '.$show->ruangan.' | '.$kondisi;

        $data = [
            'show' => $show,
            'mutasi' => $mutasi,
            'peminjaman' => $peminjaman,
            'pengembalian' => $pengembalian,
            'qr' => $qr,
        ];

        return view('pages.inventaris.aset.detail')->with('list',$data);
    }

    function ubahKondisi($token, $kondisi){
        $data = aset::where('token',$token)->first();
        $data->kondisi = $kondisi;
        $data->save();

        return response()->json($data, 200);
    }

    function getRuangan($id)
    {
        $ruangan = aset_ruangan::where('id', $id)->first();

        $last = aset::orderBy('created_at','desc')->where('id_ruangan',$id)->first();
        if (!empty($last)) {
            $kodeSarana = $last->urutan + 1;
        } else {
            $kodeSarana = '1';
        }

        $data = [
            'kodesarana' => $kodeSarana,
            'ruangan' => $ruangan->kode,
        ];

        return response()->json($data, 200);
    }

    function getTahunBulanPengadaan()
    {
        $month = Carbon::now()->isoFormat('MM');
        $year = Carbon::now()->isoFormat('YYYY');
        // $query = aset::orderBy('created_at','desc')->first();
        // if (!empty($query)) {
        //     $data = $query->urutan + 1;
        // } else {
        //     $data = '1';
        // }

        $data = [
            'month' => $month,
            'year' => $year,
        ];

        return response()->json($data, 200);
    }

    function store(Request $request)
    {
        $carbon = Carbon::now();
        $tgl = $carbon->isoFormat('dddd, D MMMM Y, HH:mm a');
        if ($request->tgl_perolehan == null) {
            $year = $carbon->isoFormat('YYYY');
        } else {
            $year = substr($request->tgl_perolehan,0,4);
        }

        $validator = Validator::make($request->all(), [
            'file.*' => 'required|mimes:jpg,png,jpeg|max:5000',
        ]);

        if ($validator->fails()) {
            $arr = json_encode($validator->errors());
            return redirect()->back()->with('error',$arr);
        } else {
            $getRuangan = aset_ruangan::where('id',$request->ruangan)->first();
            $getUrutan = aset::orderBy('created_at','desc')->first();
            if (!empty($getUrutan)) {
                $urutan = $getUrutan->urutan + 1;
            } else {
                $urutan = '1';
            }

            if ($request->jenis == 1) {
                $jenis = 'A';
            } else {
                $jenis = 'B';
            }

            $no_inventaris = '00.03.27.'.$getRuangan->kode.'.'.$jenis.'.'.$urutan.'.'.$year;

            $data = new aset;
            $data->token = Crypt::encryptString($no_inventaris); // decryptString to Decrypt
            $data->urutan = $urutan;
            $data->id_user_aset = $request->user;
            $data->id_ruangan = $request->ruangan;
            $data->jenis = $request->jenis;
            // $data->kalibrasi = $request->kalibrasi;
            $data->no_kalibrasi = $request->no_kalibrasi;
            $data->tgl_berlaku = $request->tgl_berlaku;
            $data->tgl_perolehan = $request->tgl_perolehan;
            $data->no_inventaris = $no_inventaris;
            $data->sarana = $request->sarana;
            $data->merk = $request->merk;
            $data->tipe = $request->tipe;
            $data->no_seri = $request->no_seri;
            $data->tgl_operasi = $request->tgl_operasi;
            $data->asal_perolehan = $request->asal_perolehan;
            $data->nilai_perolehan = str_replace('.','',str_replace('Rp. ','',$request->nilai_perolehan));
            $data->keterangan = $request->keterangan;
            $data->kondisi = $request->kondisi;
            $data->golongan = $request->golongan;
            $data->umur = $request->umur;
            $data->tarif = $request->tarif;
            $data->penyusutan = $request->penyusutan;
            $data->tgl_input = $carbon;

            $file_upload = $request->file('file');
            // print_r($file_upload);
            // die();
            if ($request->hasFile('file')) {
                foreach ($file_upload as $getFile) {
                    // $request->validate([
                    //     'file' => ['max:10000','mimes:jpeg,jpg,png'],
                    // ]);
                    // print_r($getFile->getClientOriginalName());
                    $array_filename[] = $getFile->store('public/files/inventaris/aset/sarana/'.$request->ruangan);
                    $array_title[] = $getFile->getClientOriginalName();
                }
                $data->filename = json_encode($array_filename);
                $data->title = json_encode($array_title);
            }
            // die();
            // print_r($array_title);
            // die();

            // $request->validate([
            //     'file' => ['max:10000','mimes:jpg'],
            // ]);
            // if ($request->file('file') && $request->file('file')->isValid()) {
            //     $data->filename = $request->file('file')->store('public/files/inventaris/aset/sarana');
            //     $data->title = $request->file('file')->getClientOriginalName();
            // }
            // print_r($data);
            // die();

            $data->save();

            return response()->json($tgl, 200);
        }
    }

    function filter(Request $request) {
        $show = aset::select('aset.*','aset_ruangan.ruangan','aset_ruangan.lokasi')
                    ->join('aset_ruangan','aset_ruangan.id','=','aset.id_ruangan')
                    ->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = aset::find($id);

        // Proses Hapus Lampiran
        $file = $data->filename;
        foreach (json_decode($file) as $key => $value) {
            Storage::delete($value);
        }

        // Proses Hapus Data dari DB
        $data->delete();

        return response()->json($tgl, 200);
    }

    // function qrcode($id)
    // {
    //     $show = aset::where('id',$id)->first();
    //     // $data = str_replace('.','',$show->no_inventaris);
    //     return response()->json($show->token, 200);
    // }

    function getAsetToken($token)
    {
        $show = aset::select('aset.*','aset_ruangan.ruangan','aset_ruangan.lokasi')
                    ->join('aset_ruangan','aset_ruangan.id','=','aset.id_ruangan')
                    ->where('token',$token)
                    ->first();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }
}
