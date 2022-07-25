<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Management
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // ! cek buat managaement
        // jika dia belum login tampilkan pesan 403 forbiden dan,
        // jika dia sudah login, cek lagi jika dia bukan admin tampilkan pesan 403
        if (!auth()->check() || auth()->user()->role_id !== 4) {
            abort(403);
        }
        return $next($request);
    }
}
