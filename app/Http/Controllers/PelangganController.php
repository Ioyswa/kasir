<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Exception;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();
        // dd($pelanggans);

        return view('index', [
            'aktivitas' => 'pelanggan',
            'pelanggans' => $pelanggans
        ]);
    }

    public function upload(request $request) {
        // dd($request);
        $request ->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        return redirect()->route('pelanggan')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request) {
        // dd($request);
        try {
            $request->validate([
                'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
                'nama_pelanggan' => 'required',
                'alamat' => 'required',
                'nomor_telepon' => 'required|',
            ]);

            $id_pelanggan = $request->id_pelanggan;

            $pelanggan = Pelanggan::findOrFail($id_pelanggan);

            $pelanggan->nama_pelanggan = $request->nama_pelanggan;
            $pelanggan->alamat = $request->alamat;
            $pelanggan->nomor_telepon = $request->nomor_telepon;

            $pelanggan->save();

            return redirect()->route('pelanggan')->with('success', 'Produk berhasil diperbarui!');
        } catch(Exception $e) {
            dd($e);

        }

    }

    public function delete($id_pelanggan) {
        $pelanggan = pelanggan::findOrFail($id_pelanggan);

        $pelanggan->delete();

        return redirect()->route('pelanggan')->with('success', 'Produk berhasil dihapus!');
    }
}
