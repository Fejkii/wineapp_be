<?php

namespace App\Http\Controllers\v1;

use App\Models\WineClassification;
use Illuminate\Http\JsonResponse;

class WineClassificationController extends Controller
{
    /**
     * @OA\Get (
     * path="/api/v1/wineClassification",
     * operationId="showWineClassification",
     * tags={"WineClassification"},
     * summary="Show all WineClassifications",
     * description="Show all WineClassifications",
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = WineClassification::all();

        return $this->sendResponse($result, "Show all Wine Classifications");
    }
}
