<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $verify_key = $request->route('verify_key');
        $sessionVerify_key = $request->cookie('verify_key');

        // dd($seed, $sessionSeed);
        if ($verify_key !== $sessionVerify_key) {
            abort(404);
        }
        return $next($request);
    }
}
