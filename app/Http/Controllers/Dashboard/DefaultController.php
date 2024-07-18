<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Models\users;
use App\Models\users_foto;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = users::where('id',Auth::user()->id)->first();
            $foto_user = users_foto::where('user_id',Auth::user()->id)->first();

            $time = Carbon::now()->isoFormat('H');
            // PENGHITUNGAN WAKTU PAGI / SIANG / SORE / MALAM
            if ($time < "10") {
                $waktu = "Pagi";
            } else {
                if ($time >= "10" && $time < "15") {
                    $waktu = "Siang";
                } else {
                    if ($time >= "15" && $time < "19") {
                        $waktu = "Sore";
                    } else {
                        if ($time >= "19") {
                            $waktu = "Malam";
                        }
                    }
                }
            }

            $kelamin = '';
            if (!empty($user->jns_kelamin)) {
                if ($user->jns_kelamin == 'LAKI-LAKI') {
                    $kelamin = 'Tn.';
                } else {
                    if ($user->jns_kelamin == 'PEREMPUAN') {
                        $kelamin = 'Ny.';
                    }
                }
            }


            $data = [
                'user' => $user,
                'foto_user' => $foto_user,
                'waktu' => $waktu,
                'kelamin' => $kelamin,
            ];

            return view('pages.dashboard.default')->with('list', $data); // ->with('list', $data)
        } else {
            return redirect()->route('auth.login');
        }
    }

    public function index2()
    {
        if (Auth::check()) {
            $user = users::where('id',Auth::user()->id)->first();
            $foto_user = users_foto::where('user_id',Auth::user()->id)->first();

            $time = Carbon::now()->isoFormat('H');
            // PENGHITUNGAN WAKTU PAGI / SIANG / SORE / MALAM
            if ($time < "10") {
                $waktu = "Pagi";
            } else {
                if ($time >= "10" && $time < "15") {
                    $waktu = "Siang";
                } else {
                    if ($time >= "15" && $time < "19") {
                        $waktu = "Sore";
                    } else {
                        if ($time >= "19") {
                            $waktu = "Malam";
                        }
                    }
                }
            }

            $kelamin = '';
            if (!empty($user->jns_kelamin)) {
                if ($user->jns_kelamin == 'LAKI-LAKI') {
                    $kelamin = 'Tn.';
                } else {
                    if ($user->jns_kelamin == 'PEREMPUAN') {
                        $kelamin = 'Ny.';
                    }
                }
            }


            $data = [
                'user' => $user,
                'foto_user' => $foto_user,
                'waktu' => $waktu,
                'kelamin' => $kelamin,
            ];

            return view('pages.dashboard.index')->with('list', $data); // ->with('list', $data)
        } else {
            return redirect()->route('auth.login');
        }
    }

    // function downloadPeraturanKepegawaian() {

    // }

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

    function clearCache()
    {
        // \Artisan::call('route:cache');
        // \Artisan::call('config:cache');
        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');
        \Artisan::call('clear-compiled');
        \Artisan::call('optimize:clear');
        return redirect()->back()->with('message','Cache berhasil dibersihkan!');
    }
}
