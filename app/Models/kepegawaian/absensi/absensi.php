<?php

namespace App\Models\kepegawaian\absensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;
    protected $table = 'kepegawaian_absensi';
    public $timestamps = true;
    use SoftDeletes;
}
