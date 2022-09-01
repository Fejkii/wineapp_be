<?php

use App\Http\Controllers\v1\AuthenticationController;
use App\Http\Controllers\v1\ProjectController;
use App\Http\Controllers\v1\UserController;
use App\Http\Controllers\v1\UserProjectController;
use Illuminate\Support\Facades\Route;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);

    // Project
    Route::post('/project', [ProjectController::class, 'create']);
    Route::put('/project/{projectId}', [ProjectController::class, 'update']);
    Route::get('/project/{projectId}', [ProjectController::class, 'show']);

    Route::post('/userProject', [UserProjectController::class, 'create']);
    Route::get('/userProject/{userProjectId}', [UserProjectController::class, 'show']);
    Route::post('/userProjectList', [UserProjectController::class, 'showList']);

    Route::get('/user', [UserController::class, 'show']);
    Route::get('/userProjects', [UserController::class, 'showUserProjects']);
    Route::get('/projectUsers/{projectId}', [UserController::class, 'showProjectUsers']);


});
