<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class perbaikan_it extends Model
{
    use HasFactory;
    protected $table = 'perbaikan_it';
    public $timestamps = true;
    use SoftDeletes;
}
