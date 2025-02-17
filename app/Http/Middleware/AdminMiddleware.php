<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        if (Auth::guard('operator')->check()){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman itu.');
        } else {
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman itu.');

        }


    }
}
