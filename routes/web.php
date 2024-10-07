<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('health', HealthCheckResultsController::class);
