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

// TODO - uncomment after finish API
//Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);

    // Project
    Route::post('/project', [ProjectController::class, 'create']);
    Route::put('/project/{projectId}', [ProjectController::class, 'update']);
    Route::get('/project/{projectId}', [ProjectController::class, 'show']);

    // UserProject
    Route::post('/userProject', [UserProjectController::class, 'create']);
    Route::get('/userProject/{userProjectId}', [UserProjectController::class, 'show']);
    Route::get('/userProject', [UserProjectController::class, 'showByParams']);
    Route::get('/userProjectList', [UserProjectController::class, 'showListByParams']);
    Route::get('/userProjects', [UserProjectController::class, 'showUserProjects']);
    Route::get('/projectUsers/{projectId}', [UserProjectController::class, 'showProjectUsers']);

    // User
    Route::get('/user', [UserController::class, 'show']);
//});
