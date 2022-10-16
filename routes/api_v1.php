<?php

use App\Http\Controllers\v1\AuthenticationController;
use App\Http\Controllers\v1\ProjectController;
use App\Http\Controllers\v1\UserController;
use App\Http\Controllers\v1\UserProjectController;
use App\Http\Controllers\v1\VineyardController;
use App\Http\Controllers\v1\VineyardWineController;
use App\Http\Controllers\v1\WineController;
use App\Http\Controllers\v1\WineEvidenceController;
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

    Route::get('/wine', [WineController::class, 'index']);
    Route::get('/wine/{wineId}', [WineController::class, 'show']);
    Route::post('/wine', [WineController::class, 'create']);
    Route::put('/wine/{wineId}', [WineController::class, 'update']);

    Route::get('/wineEvidence', [WineEvidenceController::class, 'index']);
    Route::get('/wineEvidence/{wineEvidenceId}', [WineEvidenceController::class, 'show']);
    Route::post('/wineEvidence', [WineEvidenceController::class, 'create']);
    Route::put('/wineEvidence/{wineEvidenceId}', [WineEvidenceController::class, 'update']);

    Route::get("/vineyard/{vineyardId}", [VineyardController::class, 'show']);
    Route::get("/vineyardList/{projectId}", [VineyardController::class, 'showByProject']);
    Route::post("/vineyard", [VineyardController::class, 'create']);
    Route::put("/vineyard/{projectId}", [VineyardController::class, 'update']);

    Route::get("/vineyardWine/{vineyardWineId}", [VineyardWineController::class, "show"]);
    Route::post("/vineyardWine", [VineyardWineController::class, "create"]);
    Route::put("/vineyardWine/{vineyardWineId}", [VineyardWineController::class, "update"]);

    // User
    Route::get('/user', [UserController::class, 'show']);
//});
