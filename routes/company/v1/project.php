<?php

use Illuminate\Support\Facades\Route;
use App\Application\Company\V1\Http\Controllers\Project\ProjectController;
use App\Application\Company\V1\Http\Controllers\Project\SprintController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('sprints', SprintController::class);
});
