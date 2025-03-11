<?php

namespace App\Http\Controllers\Kepegawaian\Rekrutmen;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\kepegawaian\rekrutmen\pengumuman;
use App\Models\kepegawaian\rekrutmen\registrasi;
use Carbon\Carbon;
use Auth;
use Validator,Redirect,Response,File;

class RegistrasiController extends Controller
{
    function index()
    {
        return view('pages.kepegawaian.rekrutmen.peserta.index');
    }
}
