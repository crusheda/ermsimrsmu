<?php

namespace App\Http\Controllers\MFK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\k3_accident_report;
use App\Models\roles;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class AccidentReportController extends Controller
{
    public function index()
    {
        $unit = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
        $show = k3_accident_report::get();

        $data = [
            'show' => $show,
            'unit' => $unit
        ];

        // print_r($data);
        // die();

        return view('pages.mfk.accidentreport.index')->with('list', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        if ($uploadedFile == '') {
            $path = '';
            $title = '';
        }else {
            $path = $uploadedFile->store('public/files/k3/accidentreport');
            $title = $uploadedFile->getClientOriginalName();
        }
        // print_r($path);
        // die();

        $user = Auth::user();
        $name = $user->name; //jamhuri$user = Auth::user();
        $role = $user->roles->first()->name; //kabag-keperawatan

        $thn = Carbon::now()->format('Y');
        // $thn = Carbon::now();
        $getlahir = $request->lahir;
        $parse = Carbon::parse($getlahir)->format('Y');
        // $parse = Carbon::parse($getlahir);
        $usia = $thn - $parse;

        $data = new accident_report;
        $data->tgl = $request->tgl;
        $data->lokasi = $request->lokasi;
        $data->jenis = $request->jenis;
        $data->lain1 = $request->lain1;
        $data->kronologi = $request->kronologi;

        $data->kerugian = $request->kerugian;
        $data->korban = $request->korban;
        $data->lahir = $request->lahir;
        $data->usia = $usia;
        $data->jk = $request->jk;
        $data->unit = $request->unit;
        $data->cedera = $request->cedera;
        $data->penanganan = $request->penanganan;
        $data->k_aset = $request->k_aset;
        $data->k_lingkungan = $request->k_lingkungan;

        $data->tta = $request->tta;
        $data->kta = $request->kta;
        $data->f_personal = $request->f_personal;
        $data->f_pekerjaan = $request->f_pekerjaan;
        $data->p_kerja = $request->p_kerja;
        $data->mesin = $request->mesin;
        $data->material = $request->material;
        $data->alat_berat = $request->alat_berat;
        $data->kendaraan = $request->kendaraan;
        $data->benda_bergerak = $request->benda_bergerak;
        $data->bejana_tekan = $request->bejana_tekan;
        $data->alat_listrik = $request->alat_listrik;
        $data->radiasi = $request->radiasi;
        $data->binatang = $request->binatang;
        $data->lain2 = $request->lain2;

        $data->r_tindakan = $request->r_tindakan;
        $data->t_waktu = $request->t_waktu;
        $data->wewenang = $request->wewenang;

        $data->title = $title;
        $data->filename = $path;
        $data->user = $name;


        $data->save();

        return redirect()->back()->with('message','Tambah Laporan Kecelakaan Kerja Berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = k3_accident_report::find($id);
        return Storage::download($data->filename, $data->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $thn = Carbon::now()->format('Y');
        // $thn = Carbon::now();
        $getlahir = $request->lahir;
        $parse = Carbon::parse($getlahir)->format('Y');
        // $parse = Carbon::parse($getlahir);
        $usia = $thn - $parse;

        $data = k3_accident_report::find($id);
        $data->tgl = $request->tgl;
        $data->lokasi = $request->lokasi;
        $data->jenis = $request->jenis;
        $data->lain1 = $request->lain1;
        $data->kronologi = $request->kronologi;

        $data->kerugian = $request->kerugian;
        $data->korban = $request->korban;
        $data->lahir = $request->lahir;
        $data->usia = $usia;
        $data->jk = $request->jk;
        $data->unit = $request->unit;
        $data->cedera = $request->cedera;
        $data->penanganan = $request->penanganan;
        $data->k_aset = $request->k_aset;
        $data->k_lingkungan = $request->k_lingkungan;

        $data->tta = $request->tta;
        $data->kta = $request->kta;
        $data->f_personal = $request->f_personal;
        $data->f_pekerjaan = $request->f_pekerjaan;
        $data->p_kerja = $request->p_kerja;
        $data->mesin = $request->mesin;
        $data->material = $request->material;
        $data->alat_berat = $request->alat_berat;
        $data->kendaraan = $request->kendaraan;
        $data->benda_bergerak = $request->benda_bergerak;
        $data->bejana_tekan = $request->bejana_tekan;
        $data->alat_listrik = $request->alat_listrik;
        $data->radiasi = $request->radiasi;
        $data->binatang = $request->binatang;
        $data->lain2 = $request->lain2;

        $data->r_tindakan = $request->r_tindakan;
        $data->t_waktu = $request->t_waktu;
        $data->wewenang = $request->wewenang;

        // print_r($data);
        // die();
        $data->save();

        return redirect()->back()->with('message','Perubahan Laporan Kecelakaan Kerja Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = k3_accident_report::find($id);
        $data->delete();

        // redirect
        return Redirect::back()->with('message','Hapus Laporan Berhasil');
    }

    public function download(Request $id)
    {
        $data = k3_accident_report::find($id);
        $data->filename = $filename;
        $path = storage_path($filename);

        return response()->file($pathToFile, $headers);
    }

    public function cetak($id)
    {
        $data = k3_accident_report::where('id',$id)->first();

        $tgl = Carbon::parse($data->tgl)->toDateString();
        $jam = Carbon::parse($data->tgl)->toTimeString();

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path().'/doc/k3/laporan-kak.docx');

        $user = $data->user;
        $unit = $data->unit;

        // print_r($jam);
        // die();
        $filename = "Laporan Kecelakaan Kerja | ".$user." - ".$unit;

        $jenis1 = '';
        $jenis2 = '';
        $jenis3 = '';
        $jenis4 = '';
        $jenis5 = '';
        $jenis6 = '';
        $jenis7 = '';
        $jenis8 = '';
        $jenis9 = '';
        $jenis10 = '';
        $jenis11 = '';
        $jenis12 = '';
        $jenis13 = '';
        $jenis14 = '';

        if ($data->jenis == 1) {
            $jenis1 = '√';
        }elseif ($data->jenis == 2) {
            $jenis2 = '√';
        }elseif ($data->jenis == 3) {
            $jenis3 = '√';
        }elseif ($data->jenis == 4) {
            $jenis4 = '√';
        }elseif ($data->jenis == 5) {
            $jenis5 = '√';
        }elseif ($data->jenis == 6) {
            $jenis6 = '√';
        }elseif ($data->jenis == 7) {
            $jenis7 = '√';
        }elseif ($data->jenis == 8) {
            $jenis8 = '√';
        }elseif ($data->jenis == 9) {
            $jenis9 = '√';
        }elseif ($data->jenis == 10) {
            $jenis10 = '√';
        }elseif ($data->jenis == 11) {
            $jenis11 = '√';
        }elseif ($data->jenis == 12) {
            $jenis12 = '√';
        }elseif ($data->jenis == 13) {
            $jenis13 = '√';
        }elseif ($data->jenis == 14) {
            $jenis14 = '√';
        }

        $rugi1 = '';
        $rugi2 = '';
        $rugi3 = '';
        $rugi4 = '';
        $rugi5 = '';

        if ($data->kerugian == 1) {
            $rugi1 = '√';
        }elseif ($data->kerugian == 2) {
            $rugi2 = '√';
        }elseif ($data->kerugian == 3) {
            $rugi3 = '√';
        }elseif ($data->kerugian == 4) {
            $rugi4 = '√';
        }elseif ($data->kerugian == 5) {
            $rugi5 = '√';
        }

        // $templateProcessor->setImageValue('img', array('path' => public_path($data->filename), 'width' => 500, 'height' => 500, 'ratio' => true));

        $templateProcessor->setValues([
            'tgl' => $tgl,
            'jam' => $jam,
            'lokasi' => $data->lokasi,

                '1' => $jenis1,
                '2' => $jenis2,
                '3' => $jenis3,
                '4' => $jenis4,
                '5' => $jenis5,
                '6' => $jenis6,
                '7' => $jenis7,
                '8' => $jenis8,
                '9' => $jenis9,
                '10' => $jenis10,
                '11' => $jenis11,
                '12' => $jenis12,
                '13' => $jenis13,
                '14' => $jenis14,

            'lain1' => $data->lain1,
            'kronologi' => $data->kronologi,

                'a' => $rugi1,
                'b' => $rugi2,
                'c' => $rugi3,
                'd' => $rugi4,
                'e' => $rugi5,

            'korban' => $data->korban,
            'lahir' => $data->lahir,
            'usia' => $data->usia,
            'jk' => $data->jk,
            'unit' => $data->unit,
            'cedera' => $data->cedera,
            'penanganan' => $data->penanganan,
            'k_aset' => $data->k_aset,
            'k_lingkungan' => $data->k_lingkungan,
            'tta' => $data->tta,
            'kta' => $data->kta,
            'f_personal' => $data->f_personal,
            'f_pekerjaan' => $data->f_pekerjaan,
            'p_kerja' => $data->p_kerja,
            'mesin' => $data->mesin,
            'material' => $data->material,
            'alat_berat' => $data->alat_berat,
            'kendaraan' => $data->kendaraan,
            'benda_bergerak' => $data->benda_bergerak,
            'bejana_tekan' => $data->bejana_tekan,
            'alat_listrik' => $data->alat_listrik,
            'radiasi' => $data->radiasi,
            'binatang' => $data->binatang,
            'lain2' => $data->lain2,
            'r_tindakan' => $data->r_tindakan,
            't_waktu' => $data->t_waktu,
            'wewenang' => $data->wewenang,
        ]);

        header("Content-Disposition: attachment; filename=$filename.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function verifikasi($id)
    {
        $getclock = Carbon::now();
        $data = k3_accident_report::find($id);
        $data->verifikasi = $getclock;
        $data->save();

        return Redirect::back()->with('message','Laporan berhasil di Verifikasi.');
    }
}