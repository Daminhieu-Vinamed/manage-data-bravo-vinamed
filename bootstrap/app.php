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
            'checkLogin' => \App\Http\Middleware\CheckLoginMiddleware::class,
            'checkRoleAdmin' => \App\Http\Middleware\CheckRoleAdminMiddleware::class,
            'checkRoleManage' => \App\Http\Middleware\CheckRoleManageMiddleware::class,
            'checkLogout' => \App\Http\Middleware\CheckLogoutMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();