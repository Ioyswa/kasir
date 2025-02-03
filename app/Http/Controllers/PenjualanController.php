<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;

class PenjualanController extends Controller
{
    public function index() {
        $penjualan = Penjualan::latest()->get();

        return view('index', [
            'aktivitas' => 'penjualan',
            'penjualans' => $penjualan,
        ]);
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'detailPenjualans.produk'])->findOrFail($id);
        return response()->json($penjualan);
    }

    public function store(Request $request)
    {
        // Debugging
        // dd($request);

        // Dekode order_items
        $orderItems = json_decode($request->order_items, true);

        // Hitung total harga dari order_items
        $totalHarga = array_sum(array_column($orderItems, 'subtotal'));

        // Validasi input
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'order_items' => 'required|json',
            'total_bayar' => 'required|numeric|min:0', // Ubah validasi ini
            'kembalian' => 'required|numeric|min:0'
        ]);

        // Buat penjualan
        $penjualan = Penjualan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'tanggal_penjualan' => now(),
            'total_harga' => $totalHarga, // Gunakan totalHarga yang sudah dihitung
            'total_bayar' => $request->total_bayar,
            'kembalian' => $request->kembalian
        ]);

        // Simpan detail penjualan
        foreach ($orderItems as $item) {
            DetailPenjualan::create([
                'id_penjualan' => $penjualan->id_penjualan,
                'id_produk' => $item['idProduk'],
                'jumlah_produk' => $item['jumlah'],
                'subtotal' => $item['subtotal']
            ]);
        }

        $produk = Produk::findOrFail($item['idProduk']);
        $produk->stok -= $item['jumlah'];
        $produk->save();

        // Redirect atau response
        return redirect()->back()->with('success', 'Penjualan berhasil disimpan');
    }
}
