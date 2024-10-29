<?php

use Illuminate\Support\Facades\Route;
use App\Application\Company\Http\Controllers\UserController;

Route::prefix('client')->group(function () {
    Route::post('register', [UserController::class, 'register'])->name('company.register');
});

