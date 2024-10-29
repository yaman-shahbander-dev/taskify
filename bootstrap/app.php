<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            foreach (glob(__DIR__ . '/../routes/admin/*.php') as $routeFile) {
                Route::middleware('api')
                    ->prefix('admin')
                    ->group($routeFile);
            }

            foreach (glob(__DIR__ . '/../routes/company/*.php') as $routeFile) {
                Route::middleware('api')
                    ->prefix('company')
                    ->group($routeFile);
            }

            foreach (glob(__DIR__ . '/../routes/employee/*.php') as $routeFile) {
                Route::middleware('api')
                    ->prefix('employee')
                    ->group($routeFile);
            }
        },
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


