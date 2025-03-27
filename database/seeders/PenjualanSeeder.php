<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder {
    public function run() {
        DB::table('penjualan')->insert([
            [
                'nama_pengguna' => 'User1',
                'outlet' => 'ABC Cell',
                'produk' => 'Paket Data 10GB',
                'jumlah' => 2,
                'harga' => 50000,
                'total_harga' => 100000,
                'tanggal_transaksi' => now(),
            ],
            [
                'nama_pengguna' => 'User2',
                'outlet' => 'XYZ Phone',
                'produk' => 'Pulsa 50K',
                'jumlah' => 1,
                'harga' => 50000,
                'total_harga' => 50000,
                'tanggal_transaksi' => now(),
            ],
        ]);
    }
}

