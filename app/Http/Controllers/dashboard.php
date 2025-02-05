<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Pelanggan;
use App\Models\Produk;
class dashboard extends Controller
{
    public function index()
    {
        $total_pelanggan = Pelanggan::count();
        $total_produk = Produk::count();
        $produks = Produk::orderBy('stok', 'DESC')->get();

        return view('index', [
            'aktivitas' => 'dashboard',
            'total_pelanggan' => $total_pelanggan,
            'total_produk' => $total_produk,
            'produks' => $produks,
        ]);
    }
    public function register()
    {
        return view('index', [
            'aktivitas' => 'register'
        ]);
    }



}
