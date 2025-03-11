<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Illuminate\Support\Facades\Log;

class HandleUndefinedArrayKey
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (Throwable $exception) {
            if (str_contains($exception->getMessage(), 'Undefined array key')) {
                Log::error('Undefined array key error: ' . $exception->getMessage());

                return redirect()->route('home')->with('error', 'Terjadi kesalahan, halaman direfresh.');
            }

            throw $exception;
        }
    }
}
