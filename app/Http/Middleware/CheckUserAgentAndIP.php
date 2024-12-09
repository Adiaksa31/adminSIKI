<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAgentAndIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         $allowedUserAgent = env('ALLOWED_USER_AGENTS', '');
         $allowedIP = env('ALLOWED_IPS', '');

        //  dd($request->header('User-Agent'), $allowedUserAgent, $request->ip(), $allowedIP);

        $userAgent = $request->header('User-Agent');
        if (!preg_match("/" . preg_quote($allowedUserAgent, '/') . "/", $userAgent)) {
            // return redirect('http://157.10.160.10');
            abort(403);
        }

        $ipAddress = $request->ip();
        if ( $ipAddress !== $allowedIP) {
            abort(403);
        }

        return $next($request);
    }
}
