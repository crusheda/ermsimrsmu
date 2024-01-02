<?php

namespace App\Http\Controllers\Berkas\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\kode_surat_keluar;
use App\Models\surat_keluar;
use App\Models\User;
use Carbon\Carbon;
use Validator,Redirect,Response,File;
use Exception;
use Storage;
use Auth;

class SuratKeluarController extends Controller
{
    public function index()
    {
        if (Auth::user()->getPermission('surat_keluar') == true) {
            $users = user::whereNotNull('nik')->where('status',null)->orderBy('nama','ASC')->get();
            $kode = kode_surat_keluar::orderBy('nama','ASC')->get();
            $year = Carbon::now()->isoFormat('YYYY');

            $getUrutan = surat_keluar::orderBy('urutan','DESC')->first();
            if (empty($getUrutan->urutan)) {
                // $urutan = 1;
                $urutan = sprintf("%03d", 1);
            } else {
                if (Carbon::parse($getUrutan->created_at)->isoFormat('YYYY') !== $year) {
                    $urutan = sprintf("%03d", 1);
                } else {
                    $urutan = sprintf("%03d", $getUrutan->urutan + 1);
                }
            }

            $data = [
                'users' => $users,
                'kode' => $kode,
                'urutan' => $urutan,
                'year' => $year,
            ];

            return view('pages.berkas.surat.suratkeluar.index')->with('list', $data);
        } else {
            return redirect()->back();
        }
    }

    public function apiKode($id)
    {
        $data = kode_surat_keluar::find($id);

        return response()->json($data->kode, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['max:20000','mimes:pdf'],
            'kode' => 'required',
            'tgl' => 'required',
            // 'tujuan' => 'required',
            'user' => 'required'
        ]);

        $getFile = $request->file('file');
        if ($getFile == null) {
            $path = null;
            $title = null;
        } else {
            // simpan berkas yang diunggah ke sub-direktori $path
            // direktori 'files' otomatis akan dibuat jika belum ada
            $find = surat_keluar::where('title',$getFile->getClientOriginalName())->first();
            if ($find == null) {
                $path = $getFile->store('public/files/tu/suratkeluar');
                $title = $getFile->getClientOriginalName();
            } else {
                return redirect()->back()->withErrors('Maaf, Nama file '.$getFile->getClientOriginalName().' sudah pernah diupload. Mohon Ganti Nama File yang berbeda. Disarankan untuk menambahkan kode yang unik pada File Anda.');
            }
        }

        $tahunNow = Carbon::now()->isoFormat('YYYY');
        $getJenis = kode_surat_keluar::where('id',$request->kode)->first();
        $getUrutan = surat_keluar::orderBy('urutan','DESC')->first();
        if (empty($getUrutan->urutan)) {
            $urutan = 1;
        } else {
            $urutan = $getUrutan->urutan + 1;
        }

        $data               = new surat_keluar;
        $data->urutan       = $urutan;
        $data->kode         = $request->kode;
        $data->tgl          = $request->tgl;
        if ($request->tujuan2 != null) {
            $data->tujuan2  = $request->tujuan2;
        } else {
            $data->tujuan   = json_encode($request->tujuan);
        }
        $data->nomor        = sprintf("%03d", $urutan)."/".$getJenis->kode."/DIR/III.6.AU/PKUSKH/".$tahunNow;
        $data->jenis        = $getJenis->nama;
        $data->isi          = $request->isi;
        $data->title        = $title;
        $data->filename     = $path;
        $data->user         = $request->user;

        $data->save();
        return redirect::back()->with('message','Tambah Berkas Surat Keluar Berhasil!');
    }

    // API
    public function apiGet()
    {
        $show = surat_keluar::join('berkas_surat_keluar_kode','berkas_surat_keluar_kode.id','=','berkas_surat_keluar.kode')->select('berkas_surat_keluar_kode.kode as kode_jenis','berkas_surat_keluar.*')->get();
        $getUser = user::select('id','nama')->get();
        $user = json_encode($getUser);

        $data = [
            'show' => $show,
            'user' => $user,
        ];

        return response()->json($data, 200);
    }

    public function download($id)
    {
        $data = surat_keluar::find($id);
        return Storage::download($data->filename, $data->title);
    }

    public function showChange($id)
    {
        $users = user::whereNotNull('nik')->where('status',null)->orderBy('nama','ASC')->get();
        $show = surat_keluar::find($id);
        $getKode = kode_surat_keluar::where('id',$show->kode)->first();
        $refKode = kode_surat_keluar::get();

        $kode = $getKode->kode;
        if (strlen($show->nomor) == 32) {
            $year = substr($show->nomor,28);
        } else {
            $year = substr($show->nomor,29);
        }
        $urutan = sprintf("%03d", $show->urutan);

        $data = [
            'users' => $users,
            'show' => $show,
            'refkode' => $refKode,
            'kode' => $kode,
            'year' => $year,
            'urutan' => $urutan,
        ];

        return response()->json($data, 200);
    }

    public function ubah(Request $request)
    {
        $data = array();

        $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');

        $getJenis = kode_surat_keluar::where('id', $request->kode)->first();

        $data           = surat_keluar::find($request->id_edit);
        $data->kode     = $request->kode;
        $data->tgl      = $request->tgl;
        if ($request->tujuan2 != null) {
            if ($request->tujuan != null) {
                return redirect()->route('suratkeluar.index')->withErrors('Gagal proses ubah, silakan ulangi sekali lagi.');
            } else {
                $data->tujuan2  = $request->tujuan2;
            }
        } else {
            $data->tujuan   = "[".str_replace(',','","',json_encode($request->tujuan))."]";
        }
        $data->jenis    = $getJenis->nama;
        $data->isi      = $request->isi;
        $data->user     = $request->user;

        if ($data->filename == null) {
            if ($request->file('file') && $request->file('file')->isValid()) {
                $data->filename = $request->file('file')->store('public/files/tu/suratkeluar');
                $data->title = $request->file('file')->getClientOriginalName();
            }
        } else {
            $request->validate([
                'file' => ['max:20000','mimes:pdf'],
            ]);
            $fileDeleted = $data->filename;
            Storage::delete($fileDeleted);
            if ($request->file('file') && $request->file('file')->isValid()) {
                $data->filename = $request->file('file')->store('public/files/tu/suratkeluar');
                $data->title = $request->file('file')->getClientOriginalName();
            }
        }

        $data->save();

        return response()->json($now, 200);
    }

    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $hapusData = surat_keluar::find($id);

        // Proses Hapus
        $file = $hapusData->filename;
        $hapusData->delete();

        return response()->json($tgl, 200);
    }
}
