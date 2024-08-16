<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $fillable = ['number', 'nama', 'tgl_lahir', 'tmp_lahir', 'jenis_kelamin'];
    protected $primaryKey = 'number';
}
