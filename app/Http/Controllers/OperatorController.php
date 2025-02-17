<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use Illuminate\Support\Facades\Hash;
use Exception;

class OperatorController extends Controller
{
    public function index()
    {
        $operators = Operator::latest()->get();
        // dd($pelanggans);

        return view('index', [
            'aktivitas' => 'operator',
            'operators' => $operators
        ]);
    }

    public function upload(Request $request) {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $operator = new operator();
        $operator->username = $request->username;
        $operator->password = Hash::make($request->password); // Hash password
        $operator->save();

        return redirect()->route('operator')->with('success', 'Operator berhasil ditambahkan!');

    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|exists:operator,id',
            'username' => 'required',
            'password' => 'nullable',
        ]);

        $operator = Operator::find($request->id);

        $operator->username = $request->username;

        if ($request->filled('password')) {
            $operator->password = Hash::make($request->password);
        }

        $operator->save();

        return redirect()->route('operator')->with('success', 'Operator berhasil diperbarui!');
    }

    public function delete($id) {
        $operator = Operator::find($id);

        if (!$operator) {
            return redirect()->route('operator')->with('error', 'Operator tidak ditemukan!');
        }
        $operator->delete();

        return redirect()->route('operator')->with('success', 'Operator berhasil dihapus!');
    }
}
