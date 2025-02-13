<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:operator',
            'password' => 'required|string|min:8', // Pastikan ada konfirmasi password
        ]);


        // Buat pengguna baru
        $operator = new Operator();
        $operator->username = $request->username;
        $operator->password = Hash::make($request->password); // Hash password
        $operator->save();

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);



            // Cek autentikasi untuk guard 'operator'
            if (Auth::guard('operator')->attempt(['username' => $request->username, 'password' => $request->password])) {
                // dd("anjay opertaro");
                // dd(Auth::check()); // Ini harus mengembalikan false
                return redirect()->route('kasir');
            }

            // Cek autentikasi untuk guard 'admin'
            if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
                // dd("anjay admon");
                // dd(); // Ini harus mengembalikan false
                return redirect()->route('produk');
            }

            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function logout()
    {
        Auth::logout();
        // dd(Auth::check()); // Ini harus mengembalikan false
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
