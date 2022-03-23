<?php

use App\Http\Controllers\AccountingCompanyController;
use App\Http\Controllers\AccountingDocumentController;
use App\Http\Controllers\AccountingDocumentItemController;
use App\Http\Controllers\AccountingDocumentPaymentStateController;
use App\Http\Controllers\AccountingPaymentTypeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserProjectController;
use App\Http\Controllers\VatController;
use App\Http\Controllers\WineClassificationController;
use App\Http\Controllers\WineController;
use App\Http\Controllers\WineEvidenceController;
use App\Http\Controllers\WineVarietyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);

    // Project
    Route::post('/project', [ProjectController::class, 'create']);
    Route::get('/project/{id}', [ProjectController::class, 'show']);

    Route::post('/userProject', [UserProjectController::class, 'create']);
    Route::get('/userProject/user/{userId}', [UserProjectController::class, 'showByUserId']);
    Route::get('/userProject/project/{projectId}', [UserProjectController::class, 'showByProjectId']);

    // Purchase
    Route::get('/vat', [VatController::class, 'index']);
    Route::get('/country', [CountryController::class, 'index']);
    Route::get('/paymentType', [AccountingPaymentTypeController::class, 'index']);
    Route::get('/paymentState', [AccountingDocumentPaymentStateController::class, 'index']);

    Route::get('/company', [AccountingCompanyController::class, 'index']);
    Route::get('/company/{id}', [AccountingCompanyController::class, 'show']);
    Route::post('/company', [AccountingCompanyController::class, 'create']);

    Route::get('/document', [AccountingDocumentController::class, 'index']);
    Route::get('/document/{id}', [AccountingDocumentController::class, 'show']);
    Route::post('/document', [AccountingDocumentController::class, 'create']);

    Route::get('/documentItem', [AccountingDocumentItemController::class, 'index']);
    Route::get('/documentItem/{id}', [AccountingDocumentItemController::class, 'show']);
    Route::post('/documentItem', [AccountingDocumentItemController::class, 'create']);

    // Wine
    Route::get('/wineVariety', [WineVarietyController::class, 'index']);
    Route::get('/wineClassification', [WineClassificationController::class, 'index']);

    Route::get('/wine', [WineController::class, 'index']);
    Route::get('/wine/{id}', [WineController::class, 'show']);
    Route::post('/wine', [WineController::class, 'create']);
    Route::put('/wine/{id}', [WineController::class, 'update']);

    Route::get('/wineEvidence', [WineEvidenceController::class, 'index']);
    Route::get('/wineEvidence/{id}', [WineEvidenceController::class, 'show']);
    Route::post('/wineEvidence', [WineEvidenceController::class, 'create']);
    Route::put('/wineEvidence/{id}', [WineEvidenceController::class, 'update']);
});
