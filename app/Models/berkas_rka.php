<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class berkas_rka extends Model
{
    use HasFactory;
    protected $table = 'berkas_rka';
    public $timestamps = true;
    use SoftDeletes;
}
