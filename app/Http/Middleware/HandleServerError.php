<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleServerError
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (\Throwable $e) {
            return redirect()->route('home')->with('error', 'Aplikasi mengalami masalah, silakan coba lagi.');
        }
    }
}
