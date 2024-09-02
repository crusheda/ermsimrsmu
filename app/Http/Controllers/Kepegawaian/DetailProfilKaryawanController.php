<?php

namespace App\Http\Controllers\Kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\referensi;
use App\Models\datalogs;
use App\Models\users;
use App\Models\users_foto;
use App\Models\users_status;
use App\Models\users_rotasi;
use App\Models\logs;
use App\Models\alamat;
use App\Models\model_has_roles;
use App\Models\roles;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class DetailProfilKaryawanController extends Controller
{
    function table()
    {
        $show = users::where('status',null)->orderBy('updated_at','desc')->get();

        $data = [
            'show' => $show
        ];

        return response()->json($data, 200);
    }

    function tablePenetapan($id)
    {
        $show = DB::table('users_status')
                ->join('referensi','referensi.id','=','users_status.ref_id')
                ->select('referensi.deskripsi as nama_referensi','users_status.*')
                ->where('users_status.pegawai_id',$id)
                ->orderBy('updated_at','desc')
                ->get();

        $data = [
            'show' => $show
        ];

        return response()->json($data, 200);
    }

    function tambahPenetapan(Request $request)
    {
        $now = Carbon::now();
        $tgl = $now->isoFormat('dddd, D MMMM Y, HH:mm a');
        $tgl_berlaku = $now->isoFormat('YYYY-MM-DD');

        // VALIDASI DATA
        $validasi = users_status::where('pegawai_id',$request->pegawai_id)->orderBy('created_at','desc')->first();
        if (!empty($validasi) || $validasi != '') {
            $validasi->status = 0;
            $validasi->save();
            // $validasi->update([
            //     'status'     => false,
            // ]);
        }

        // SAVING DATA
        $data = new users_status;
        $data->ref_id = $request->ref;
        $data->user_id = $request->user_id;
        $data->pegawai_id = $request->pegawai_id;
        $data->keterangan = $request->ket;
        $data->tgl_berlaku = $now;
        $data->status = true;
        $data->save();

        // CEK DATA & SAVE LOG
        $cekData = referensi::find($request->ref);
        $cekPegawai = users::find($request->pegawai_id);
        datalogs::record($request->user_id, 'Baru saja melakukan perubahan Status Pegawai '.$cekPegawai->nama.' menjadi '.$cekData->deskripsi, 'Berlaku mulai tanggal '.$tgl_berlaku, null, $data, '["kabag-kepegawaian","kasubag-kepegawaian","kepegawaian"]');

        return response()->json($tgl, 200);
    }
}
