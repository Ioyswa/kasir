<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
   public function index()
    {
        $produks = Produk::latest()->get();

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
            'image' => 'image|mimes:jpeg,png,jpg|max:4048'
        ]);
        // dd($request['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('gambar_produk', 'public');
            // dd($image, $imagePath);
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'image' => 'storage/' . $imagePath
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request) {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg|max:4048'
        ]);

        $id_produk = $request->id_produk;
        $produk = Produk::findOrFail($id_produk);
        // dd($produk->image);

        if ($request->hasFile('image')) {
            if ($produk->image) {
                // Menghapus 'storage/' dari path gambar yang ada
                $oldImagePath = str_replace('storage/', '', $produk->image);

                // dd(Storage::allFiles('public/gambar_produk'));
                // dd(Storage::exists('app'),'public/storage/' . $oldImagePath);

                // dd($oldImagePath, 'public/' . $oldImagePath);

                // Cek apakah file ada sebelum dihapus
                if (storage_path('app/public/' . $oldImagePath)) {
                    // Hapus file
                    Storage::delete(storage_path('app/public/' . $oldImagePath)); // Ini akan mengembalikan true jika berhasil
                } else {
                    dd('File tidak ditemukan: public/' . $oldImagePath);
                }
            }

            // Simpan
            $image = $request->file('image');
            $imagePath = $image->store('gambar_produk', 'public');
            $produk->image = 'storage/' . $imagePath;
        }

        // Update data produk lainnya
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function delete($id_produk) {
        // Temukan produk berdasarkan ID
        $produk = Produk::findOrFail($id_produk);

        // Hapus semua detail penjualan yang terkait dengan produk ini
        DetailPenjualan::where('id_produk', $id_produk)->delete();

        // Hapus produk
        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus!');
    }


}
