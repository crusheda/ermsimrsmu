<?php

namespace App\Http\Controllers\Pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan;
use App\Models\pengadaan_barang;
use App\Models\pengadaan_detail;
use App\Models\pengadaan_ref;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use \PDF;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = pengadaan::get();

        $data = [
            'show' => $show
        ];
        // print_r($data);
        // die();

        return view('pages.pengadaan.index')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // API
    function dataPengadaan($id)
    {
        $pengadaan = pengadaan::where('id_user', $id)->orderBy('tgl_pengadaan','desc')->get();
        // $detail_pengadaan = pengadaan::join('pengadaan_detail','pengadaan_detail.id_pengadaan','=','pengadaan.id_pengadaan')
        //                     ->where('id_user', $id)
        //                     ->select('pengadaan.id_user','pengadaan_detail.*')
        //                     ->get();

        $data = [
            'pengadaan' => $pengadaan,
            // 'detail_pengadaan' => $detail_pengadaan
        ];

        return response()->json($data, 200);
    }

    function riwayatPengadaan($id)
    {
        $pengadaan = pengadaan::join('users','users.id','=','pengadaan.id_user')
                                ->where('pengadaan.id', $id)
                                ->select('pengadaan.*','users.nama as nama_user')
                                ->first();
        $detail = pengadaan_detail::join('pengadaan_barang','pengadaan_barang.id','=','pengadaan_detail.id_barang')
                                ->where('pengadaan_detail.id_pengadaan', $id)
                                ->select('pengadaan_detail.*','pengadaan_barang.nama as nama_barang','pengadaan_barang.satuan','pengadaan_barang.harga')
                                ->get();

        $data = [
            'pengadaan' => $pengadaan,
            'detail' => $detail
        ];

        return response()->json($data, 200);
    }

    function dataBarang()
    {
        $barang = pengadaan_barang::orderBy('nama','asc')->get();

        $data = [
            'barang' => $barang,
        ];

        return response()->json($data, 200);
    }

    function loadMore()
    {
        $barang = pengadaan_barang::orderBy('nama','asc')->paginate(12);

        // print_r($barang);
        // die();

        return response()->json($barang, 200);
		// return view('pages.pengadaan.index',compact('barang'));
    }

    // function acbarang(Request $request)
    // {
    //     $getData = pengadaan_barang::select("nama")
    //             ->where("nama","LIKE","%{$request->caribarang}%")
    //             ->groupBy ('nama')
    //             ->get();

    //     foreach ($getData as $item)
    //     {
    //         $data[] = $item->nama;
    //     }

    //     return response()->json($data);
    // }

    function getacbarang(Request $request)
    {
        $barang = pengadaan_barang::where("nama","LIKE","%{$request->barang}%")->orderBy('nama','asc')->paginate(12);

        // print_r($barang);
        // die();

        return response()->json($barang, 200);
		// return view('pages.pengadaan.index',compact('barang'));
    }
}
