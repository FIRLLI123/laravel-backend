<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'nama_pengguna',
        'outlet',
        'produk',
        'jumlah',
        'harga',
        'total_harga',
        'tanggal_transaksi',
    ];
}
