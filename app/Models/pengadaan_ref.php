<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class pengadaan_ref extends Model
{
    use HasFactory;
    protected $table = 'pengadaan_ref';
    public $timestamps = true;
    use SoftDeletes;
}