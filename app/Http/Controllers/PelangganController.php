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
            'alamat_pelanggan' => 'required',
            'nomor_telepon_pelanggan' => 'required|digits_between:10,15',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'nomor_telepon_pelanggan' => $request->nomor_telepon_pelanggan,
        ]);

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function update(Request $request) {
        // dd($request);
        try {
            $request->validate([
                'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
                'nama_pelanggan' => 'required',
                'alamat_pelanggan' => 'required',
                'nomor_telepon_pelanggan' => 'required|',
            ]);

            $id_pelanggan = $request->id_pelanggan;

            $pelanggan = Pelanggan::findOrFail($id_pelanggan);

            $pelanggan->nama_pelanggan = $request->nama_pelanggan;
            $pelanggan->alamat_pelanggan = $request->alamat_pelanggan;
            $pelanggan->nomor_telepon_pelanggan = $request->nomor_telepon_pelanggan;

            $pelanggan->save();

            return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil diperbarui!');
        } catch(Exception $e) {
            dd($e);

        }

    }

    public function delete($id_pelanggan) {
        $pelanggan = pelanggan::findOrFail($id_pelanggan);

        $pelanggan->delete();

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
