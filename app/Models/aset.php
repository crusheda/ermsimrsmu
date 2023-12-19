<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class aset extends Model
{
    use HasFactory;
    protected $table = 'aset';
    public $timestamps = true;
    use SoftDeletes;
}