<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class kode_surat_keluar extends Model
{
    use HasFactory;
    protected $table = 'berkas_surat_keluar_kode';
    public $timestamps = true;
    use SoftDeletes;
}
