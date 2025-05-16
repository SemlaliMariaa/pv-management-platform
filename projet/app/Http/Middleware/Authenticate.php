<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
     public function handle(Request $request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect()->route('loginform'); // make sure this route exists
        }

        return $next($request);
    }
}
