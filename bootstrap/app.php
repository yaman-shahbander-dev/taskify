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

            foreach (glob(__DIR__ . '/../routes/admin/v1/*.php') as $routeFile) {
                Route::middleware('api')
                    ->prefix('admin/v1')
                    ->group($routeFile);
            }

            foreach (glob(__DIR__ . '/../routes/company/v1/*.php') as $routeFile) {
                Route::middleware('api')
                    ->prefix('company/v1')
                    ->group($routeFile);
            }

            foreach (glob(__DIR__ . '/../routes/employee/v1/*.php') as $routeFile) {
                Route::middleware('api')
                    ->prefix('employee/v1')
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


