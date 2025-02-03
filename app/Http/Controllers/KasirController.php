<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;

class KasirController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::select('id_pelanggan', 'nama_pelanggan')->get();
        $produks = Produk::select('id_produk', 'nama_produk', 'harga', 'stok')->get();

        return view('index', [
            'aktivitas' => 'kasir',
            'pelanggans' => $pelanggans,
            'produks' => $produks,
        ]);
    }
}
