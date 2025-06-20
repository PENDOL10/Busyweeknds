<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registrasi middleware alias di sini
        $middleware->alias([
            'auth.admin' => \App\Http\Middleware\AuthAdmin::class,
            'auth.user' => \App\Http\Middleware\AuthUser::class,
            'auth.owner' => \App\Http\Middleware\AuthOwner::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();