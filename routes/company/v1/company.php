<?php

use Illuminate\Support\Facades\Route;
use App\Application\Company\V1\Http\Controllers\Company\DepartmentController;
use App\Application\Company\V1\Http\Controllers\Company\TeamController;
use App\Application\Company\V1\Http\Controllers\Company\TaskController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('teams', TeamController::class);
    Route::apiResource('tasks', TaskController::class);
});
