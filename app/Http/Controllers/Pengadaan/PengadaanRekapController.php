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
use Auth, DB;

class PengadaanRekapController extends Controller
{
    function index(Request $request)
    {
        if (Auth::user()->getPermission('admin_pengadaan') == true) {

            if ($request->kategori == 1) {
                $nama_kategori = 'ATK';
            } else {
                if ($request->kategori == 1) {
                    $nama_kategori = 'Cetak';
                } else {
                    $nama_kategori = 'BHP';
                }
            }


            $data = [
                'bln' => $request->bulan,
                'thn' => $request->tahun,
                'nama_kategori' => $nama_kategori,
                'kategori' => $request->kategori,
            ];

            // $bulan = $request->bulan;
            // $tahun = $request->tahun;
            // $kategori = $request->kategori;

            // $bln = Carbon::create()->month($bulan)->isoFormat('MMMM');

            // $unit = pengadaan::join('users','pengadaan.id_user','=','users.id')
            //                 ->select('users.id as id_user','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.tgl_pengadaan')
            //                 ->whereYear('pengadaan.tgl_pengadaan', $tahun)
            //                 ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
            //                 ->groupBy('users.id','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.tgl_pengadaan')
            //                 ->orderBy('pengadaan.unit','ASC')
            //                 ->get();

            // $barang = pengadaan_detail::join('pengadaan_barang','pengadaan_detail.id_barang','=','pengadaan_barang.id')
            //                 ->join('pengadaan','pengadaan_detail.id_pengadaan','=','pengadaan.id_pengadaan')
            //                 ->select('pengadaan_detail.id_barang','pengadaan_barang.nama as nama_barang','pengadaan_detail.satuan as satuan_barang','pengadaan_detail.harga as harga_barang','pengadaan_detail.ket as ket_barang')
            //                 ->whereYear('pengadaan.tgl_pengadaan', $tahun)
            //                 ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
            //                 ->where('pengadaan_barang.ref_barang', $kategori)
            //                 ->orderBy('pengadaan_barang.nama','ASC')
            //                 ->groupBy('pengadaan_detail.id_barang','pengadaan_barang.nama','pengadaan_detail.satuan','pengadaan_detail.harga','pengadaan_detail.ket')
            //                 ->get();

            // $total = pengadaan::select('total')
            //                 ->whereYear('tgl_pengadaan', $tahun)
            //                 ->whereMonth('tgl_pengadaan', $bulan)
            //                 ->groupBy('total')
            //                 ->orderBy('unit','ASC')
            //                 ->get();

            // $ref = pengadaan_ref::where('id',$kategori)->first();

            // $data = [
            //     'bln' => $bln,
            //     'bulan' => $bulan,
            //     'tahun' => $tahun,
            //     'total' => $total,
            //     'unit' => $unit,
            //     'barang' => $barang,
            //     'ref' => $ref,
            // ];

            return view('pages.pengadaan.rekap')->with('list', $data);
        } else {
            return redirect()->back();
        }
    }

    function table($bln, $thn, $kategori)
    {
        $data = DB::table('pengadaan_detail as d')
            ->join('pengadaan as p', 'd.id_pengadaan', '=', 'p.id')
            ->join('pengadaan_barang as b', 'd.id_barang', '=', 'b.id')
            ->select(
                'b.id as barang_id',
                'b.nama as barang_nama',
                DB::raw('JSON_UNQUOTE(JSON_EXTRACT(p.unit, "$[0]")) as unit_nama'),
                DB::raw('SUM(d.jumlah) as jumlah'),
                DB::raw('SUM(d.total) as total'),
                DB::raw('MIN(d.ket) as keterangan')
            )
            ->whereMonth('p.tgl_pengadaan', $bln)  // ⬅ gunakan tgl_pengadaan
            ->whereYear('p.tgl_pengadaan', $thn)   // ⬅ gunakan tgl_pengadaan
            ->where('b.ref_barang', $kategori)
            // ->whereRaw('JSON_CONTAINS(p.unit, \'["ttk"]\')') // filter jika hanya ingin unit tertentu
            ->groupBy('b.id', 'b.nama', DB::raw('JSON_UNQUOTE(JSON_EXTRACT(p.unit, "$[0]"))'))
            ->get();

        // Susun data
        $grouped = [];
        foreach ($data as $row) {
            $grouped[$row->barang_id]['id'] = $row->barang_id;
            $grouped[$row->barang_id]['nama'] = $row->barang_nama;
            $grouped[$row->barang_id]['units'][$row->unit_nama] = [
                'jumlah' => $row->jumlah,
                'total' => $row->total,
                'keterangan' => $row->keterangan
            ];
        }

        // Ambil semua unit untuk header dinamis
        $allUnits = $data->pluck('unit_nama')->unique()->values();

        return response()->json([
            'data' => array_values($grouped),
            'units' => $allUnits
        ]);
    }
}
