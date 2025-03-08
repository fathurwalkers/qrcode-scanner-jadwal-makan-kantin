<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;

class CekLogin
{
    public function handle(Request $request, Closure $next)
    {
        $cek_users = session('data_login');
        if($cek_users){
            View::share('users', $cek_users);
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
