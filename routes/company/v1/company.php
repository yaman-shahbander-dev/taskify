<?php

use Illuminate\Support\Facades\Route;
use App\Application\Company\V1\Http\Controllers\Company\DepartmentController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('departments', DepartmentController::class);
});
