<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = ['buku_id', 'customer_id', 'lama_pinjam', 'tgl_pinjam'];

    public function buku() {
        return $this->belongsTo(Buku::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'number');
    }
}
