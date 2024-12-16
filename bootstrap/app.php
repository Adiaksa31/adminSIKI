<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckUserAgentAndIP;
use App\Http\Middleware\AuthGuestMiddleware;
use App\Http\Middleware\AuthApiMiddleware;
use App\Http\Middleware\CheckVerify;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check.useragent.ip' => CheckUserAgentAndIP::class,
            'guestApi' => AuthGuestMiddleware::class,
            "authApi" => AuthApiMiddleware::class,
            'check.admin.permission' => \App\Http\Middleware\CheckAdminPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
