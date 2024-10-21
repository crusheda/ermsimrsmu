<?php

namespace App\Models\kepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class pd_ceklis extends Model
{
    use HasFactory;
    protected $table = 'kepegawaian_pd_ceklis';
    public $timestamps = true;
    use SoftDeletes;
}