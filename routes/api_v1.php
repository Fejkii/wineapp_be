<?php

use App\Http\Controllers\v1\AuthenticationController;
use App\Http\Controllers\v1\ProjectController;
use App\Http\Controllers\v1\UserController;
use App\Http\Controllers\v1\UserProjectController;
use App\Http\Controllers\v1\VineyardController;
use App\Http\Controllers\v1\VineyardRecordController;
use App\Http\Controllers\v1\VineyardRecordTypeController;
use App\Http\Controllers\v1\VineyardWineController;
use App\Http\Controllers\v1\WineClassificationController;
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

Route::get('migrate', function() {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh --seed');
});

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
    Route::post('/userProject/list', [UserProjectController::class, 'showListByParams']);
    Route::get('/userProject/project/{projectId}', [UserProjectController::class, 'showByProject']);
    Route::delete('/userProject/{userProjectId}', [UserProjectController::class, 'delete']);
    Route::put('/userProject/{userProjectId}', [UserProjectController::class, 'update']);

    Route::get('/wine/{wineId}', [WineController::class, 'show']);
    Route::get('/wine/project/{projectId}', [WineController::class, 'showByProject']);
    Route::post('/wine', [WineController::class, 'create']);
    Route::put('/wine/{wineId}', [WineController::class, 'update']);

    Route::get('/wineVariety/project/{projectId}', [WineVarietyController::class, 'showByProject']);
    Route::post('/wineVariety', [WineVarietyController::class, 'create']);
    Route::put('/wineVariety/{wineVarietyId}', [WineVarietyController::class, 'update']);

    Route::get('/wineClassification', [WineClassificationController::class, 'index']);

    Route::get('/wineEvidence/{wineEvidenceId}', [WineEvidenceController::class, 'show']);
    Route::get('/wineEvidence/project/{projectId}', [WineEvidenceController::class, 'showByProject']);
    Route::post('/wineEvidence', [WineEvidenceController::class, 'create']);
    Route::put('/wineEvidence/{wineEvidenceId}', [WineEvidenceController::class, 'update']);

    Route::get("/wineRecord/{wineRecordId}", [WineRecordController::class, "show"]);
    Route::get("/wineRecord/wineEvidence/{wineEvidenceId}", [WineRecordController::class, "showByWineEvidence"]);
    Route::post("/wineRecord", [WineRecordController::class, "create"]);
    Route::put("/wineRecord/{wineRecordId}", [WineRecordController::class, 'update']);

    Route::get("/wineRecordType", [WineRecordTypeController::class, "index"]);
    Route::post("/wineRecordType", [WineRecordTypeController::class, "create"]);

    Route::get("/vineyard/{vineyardId}", [VineyardController::class, 'show']);
    Route::post("/vineyard", [VineyardController::class, 'create']);
    Route::put("/vineyard/{vineyardId}", [VineyardController::class, 'update']);
    Route::get("/vineyard/project/{projectId}", [VineyardController::class, 'showByProject']);

    Route::get("/vineyardWine/{vineyardWineId}", [VineyardWineController::class, "show"]);
    Route::post("/vineyardWine", [VineyardWineController::class, "create"]);
    Route::put("/vineyardWine/{vineyardWineId}", [VineyardWineController::class, "update"]);
    Route::get("/vineyardWine/vineyard/{vineyardId}", [VineyardWineController::class, "showByVineyard"]);

    Route::get("/vineyardRecord/{vineyardRecordId}", [VineyardRecordController::class, "show"]);
    Route::post("/vineyardRecord", [VineyardRecordController::class, "create"]);
    Route::put("/vineyardRecord/{vineyardRecordId}", [VineyardRecordController::class, 'update']);
    Route::get("/vineyardRecord/vineyard/{vineyardId}", [VineyardRecordController::class, "showByVineyard"]);
    Route::get("/vineyardRecord/vineyardWine/{vineyardWineId}", [VineyardRecordController::class, "showByVineyardWine"]);

    Route::get("/vineyardRecordType", [VineyardRecordTypeController::class, "index"]);
    Route::post("/vineyardRecordType", [VineyardRecordTypeController::class, "create"]);

    // User
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/user/{userId}', [UserController::class, 'update']);
});
