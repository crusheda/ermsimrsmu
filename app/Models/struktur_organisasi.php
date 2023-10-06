<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class struktur_organisasi extends Model
{
    use HasFactory;
    protected $table = 'struktur_organisasi';
    public $timestamps = true;
    use SoftDeletes;
}
