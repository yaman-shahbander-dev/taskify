<?php

use Illuminate\Support\Facades\Route;
use App\Application\Company\V1\Http\Controllers\Project\ProjectController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('projects', ProjectController::class);
});
