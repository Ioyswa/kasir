<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();

        return view('index', [
            'aktivitas' => 'produk',
            'produks' => $produks
        ]);
    }

    public function upload(request $request) {
        // dd($request);
        $request ->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
           'stok' => $request->stok,
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request) {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $id_produk = $request->id_produk;

        $produk = Produk::findOrFail($id_produk);

        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function delete($id_produk) {
        $produk = Produk::findOrFail($id_produk);

        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus!');
    }


}
