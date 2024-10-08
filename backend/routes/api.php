<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ProjectController;
//Route::middleware(['api', 'auth.basic'])->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class)->except(['index']);
    Route::get('projects/{project}/tasks', [TaskController::class, 'index']);
//});
