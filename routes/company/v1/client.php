<?php

use App\Application\Company\V1\Http\Controllers\Client\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('client')->group(function () {
    Route::post('register', [UserController::class, 'register'])->name('company.register');
});

