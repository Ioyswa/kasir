<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;
class dashboard extends Controller
{
    public function index()
    {
        $total_pelanggan = Pelanggan::count();
        $total_produk = Produk::count();
        return view('index', [
            'aktivitas' => 'dashboard',
            'total_pelanggan' => $total_pelanggan,
            'total_produk' => $total_produk,
        ]);
    }
    public function register()
    {
        return view('index', [
            'aktivitas' => 'register'
        ]);
    }



}
