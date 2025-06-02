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
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
        ]);

        // Kalau kamu mau tambahkan middleware group, bisa ditambahkan di sini juga:
        // $middleware->group('web', [...]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
