<?php

use App\Http\Controllers\v1\AuthenticationController;
use App\Http\Controllers\v1\ProjectController;
use App\Http\Controllers\v1\UserController;
use App\Http\Controllers\v1\UserProjectController;
use App\Http\Controllers\v1\VineyardController;
use App\Http\Controllers\v1\VineyardRecordController;
use App\Http\Controllers\v1\VineyardRecordTypeController;
use App\Http\Controllers\v1\VineyardWineController;
use App\Http\Controllers\v1\WineController;
use App\Http\Controllers\v1\WineEvidenceController;
use App\Http\Controllers\v1\WineRecordController;
use App\Http\Controllers\v1\WineRecordTypeController;
use App\Http\Controllers\v1\WineVarietyController;
use Illuminate\Support\Facades\Route;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

// TODO - uncomment after finish API
Route::middleware('auth:sanctum')->group(function () {
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
    Route::get('/wineByProject/{projectId}', [WineController::class, 'showByProject']);
    Route::post('/wine', [WineController::class, 'create']);
    Route::put('/wine/{wineId}', [WineController::class, 'update']);

    Route::get('/wineVarietyByProject/{projectId}', [WineVarietyController::class, 'showByProject']);
    Route::post('/wineVariety', [WineVarietyController::class, 'create']);
    Route::put('/wineVariety/{wineVarietyId}', [WineVarietyController::class, 'update']);

    Route::get('/wineEvidence', [WineEvidenceController::class, 'index']);
    Route::get('/wineEvidence/{wineEvidenceId}', [WineEvidenceController::class, 'show']);
    Route::post('/wineEvidence', [WineEvidenceController::class, 'create']);
    Route::put('/wineEvidence/{wineEvidenceId}', [WineEvidenceController::class, 'update']);

    Route::get("/wineRecord/{wineRecordId}", [WineRecordController::class, "show"]);
    Route::post("/wineRecord", [WineRecordController::class, "create"]);
    Route::put("/wineRecord/{wineRecordId}", [WineRecordController::class, 'update']);

    Route::get("/wineRecordType", [WineRecordTypeController::class, "index"]);
    Route::post("/wineRecordType", [WineRecordTypeController::class, "create"]);

    Route::get("/vineyard/{vineyardId}", [VineyardController::class, 'show']);
    Route::get("/vineyardList/{projectId}", [VineyardController::class, 'showByProject']);
    Route::post("/vineyard", [VineyardController::class, 'create']);
    Route::put("/vineyard/{projectId}", [VineyardController::class, 'update']);

    Route::get("/vineyardWine/{vineyardWineId}", [VineyardWineController::class, "show"]);
    Route::post("/vineyardWine", [VineyardWineController::class, "create"]);
    Route::put("/vineyardWine/{vineyardWineId}", [VineyardWineController::class, "update"]);

    Route::get("/vineyardRecord/{vineyardRecordId}", [VineyardRecordController::class, "show"]);
    Route::post("/vineyardRecord", [VineyardRecordController::class, "create"]);
    Route::put("/vineyardRecord/{vineyardRecordId}", [VineyardRecordController::class, 'update']);

    Route::get("/vineyardRecordType", [VineyardRecordTypeController::class, "index"]);
    Route::post("/vineyardRecordType", [VineyardRecordTypeController::class, "create"]);

    // User
    Route::get('/user', [UserController::class, 'show']);
});
