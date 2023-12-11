<?php

namespace App\Http\Controllers\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\pengadaan;
use App\Models\pengadaan_keranjang;
use App\Models\pengadaan_barang;
use App\Models\pengadaan_detail;
use App\Models\pengadaan_ref;
use Carbon\Carbon;
use Auth;

class PengadaanRekapController extends Controller
{
    function index(Request $request)
    {
        if (Auth::user()->getPermission('admin_pengadaan') == true) {
            $bulan = $request->bulan;
            $tahun = $request->tahun;

            $bln = Carbon::create()->month($bulan)->isoFormat('MMMM');

            $unit = pengadaan::join('users','pengadaan.id_user','=','users.id')
                            ->select('users.id as id_user','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.tgl_pengadaan')
                            ->whereYear('pengadaan.tgl_pengadaan', $tahun)
                            ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
                            ->groupBy('users.id','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.tgl_pengadaan')
                            ->orderBy('pengadaan.unit','ASC')
                            ->get();

            $barang = pengadaan_detail::join('pengadaan_barang','pengadaan_detail.id_barang','=','pengadaan_barang.id')
                            ->join('pengadaan','pengadaan_detail.id_pengadaan','=','pengadaan.id_pengadaan')
                            ->select('pengadaan_detail.id_barang','pengadaan_barang.nama as nama_barang','pengadaan_detail.satuan as satuan_barang','pengadaan_detail.harga as harga_barang')
                            ->whereYear('pengadaan.tgl_pengadaan', $tahun)
                            ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
                            ->orderBy('pengadaan_barang.nama','ASC')
                            ->groupBy('pengadaan_detail.id_barang','pengadaan_barang.nama','pengadaan_detail.satuan','pengadaan_detail.harga')
                            ->get();

            $total = pengadaan::select('total')
                            ->whereYear('tgl_pengadaan', $tahun)
                            ->whereMonth('tgl_pengadaan', $bulan)
                            ->groupBy('total')
                            ->orderBy('unit','ASC')
                            ->get();

            $data = [
                'bln' => $bln,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'total' => $total,
                'unit' => $unit,
                'barang' => $barang,
            ];

            // $unit = pengadaan::join('users','pengadaan.id_user','=','users.id')
            //                 ->select('users.id as id_user','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.created_at')
            //                 ->whereYear('pengadaan.tgl_pengadaan', $tahun)
            //                 ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
            //                 ->groupBy('users.id','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.created_at')
            //                 ->orderBy('pengadaan.unit','ASC')
            //                 ->get();

            // $show = pengadaan_detail::join('pengadaan_barang','pengadaan_detail.id_barang','=','pengadaan_pengadaan_barangid')
            //                 ->join('pengadaan','pengadaan_detail.id_pengadaan','=','pengadaan.id_pengadaan')
            //                 ->select('pengadaan.id_pengadaan','pengadaan.unit','pengadaan_detail.id_barang','pengadaan_detail.jumlah','pengadaan_detail.total')
            //                 ->whereYear('pengadaan.tgl_pengadaan', $tahun)
            //                 ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
            //                 // ->groupBy('pengadaan.unit','pengadaan_detail.id_barang','pengadaan_detail.jumlah','pengadaan_detail.total')
            //                 ->orderBy('pengadaan.unit','ASC')
            //                 ->get();

            // $barang = pengadaan_detail::join('pengadaan_barang','pengadaan_detail.id_barang','=','pengadaan_pengadaan_barangid')
            //                 ->join('pengadaan','pengadaan_detail.id_pengadaan','=','pengadaan.id_pengadaan')
            //                 ->select('pengadaan_detail.id_barang','pengadaan_pengadaan_barangnama as nama_barang','pengadaan_detail.satuan as satuan_barang','pengadaan_detail.harga as harga_barang')
            //                 ->whereYear('pengadaan.tgl_pengadaan', $tahun)
            //                 ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
            //                 ->orderBy('pengadaan_pengadaan_barangnama','ASC')
            //                 ->groupBy('pengadaan_detail.id_barang','pengadaan_pengadaan_barangnama','pengadaan_detail.satuan','pengadaan_detail.harga')
            //                 ->get();

            // $data = [
            //     'show' => $show,
            //     'unit' => $unit,
            //     'barang' => $barang,
            // ];

            return view('pages.pengadaan.rekap')->with('list', $data);
        } else {
            return redirect()->back();
        }
    }
}
