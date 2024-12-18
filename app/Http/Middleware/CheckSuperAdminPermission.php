<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\PermissionHelper;

class CheckSuperAdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        PermissionHelper::init();

        if (!PermissionHelper::hasRole('admin')) {
            abort(404);
        }
        return $next($request);
    }
}
