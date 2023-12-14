<?php

namespace App\Http\Controllers\Inventaris\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\users;
use App\Models\roles;
use App\Models\aset_ruangan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class AsetRuanganController extends Controller
{
    function index()
    {
        if (Auth::user()->getRole('kasubag-aset') == true || Auth::user()->getRole('it') == true) {
            $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();

            $data = [
                'role' => $role,
            ];

            return view('pages.inventaris.aset.ruangan.index')->with('list',$data);
        } else {
            return redirect()->back();
        }
    }

    function table()
    {
        $show = aset_ruangan::get();
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();

        $data = [
            'show' => $show,
            'role' => $role,
        ];

        return response()->json($data, 200);
    }

    function store(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = new aset_ruangan;
        $data->id_user_ruangan = $request->user;
        $data->kode = $request->kode;
        $data->ruangan = $request->ruangan;
        $data->lokasi = $request->lokasi;
        $data->unit = json_encode($request->unit);

        $data->save();

        return response()->json($tgl, 200);
    }
}
