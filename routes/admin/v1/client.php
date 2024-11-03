<?php

use Illuminate\Support\Facades\Route;
use App\Application\Admin\V1\Http\Controllers\Client\UserController;

Route::prefix('client')->group(function () {
    Route::post('login', [UserController::class, 'login']);
});
