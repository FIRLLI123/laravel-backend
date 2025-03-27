<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PenjualanController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'nama_pengguna' => 'required|string',
            'outlet' => 'required|string',
            'produk' => 'required|string',
            'jumlah' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $total_harga = $request->jumlah * $request->harga;

        $penjualan = Penjualan::create([
            'nama_pengguna' => $request->nama_pengguna,
            'outlet' => $request->outlet,
            'produk' => $request->produk,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total_harga' => $total_harga,
        ]);

        return response()->json($penjualan, Response::HTTP_CREATED);
    }

    public function index() {
        return response()->json(Penjualan::all());
    }
}
