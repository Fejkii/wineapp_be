<?php

namespace App\Http\Controllers;

use App\Models\WineClassification;
use Illuminate\Http\JsonResponse;

class WineClassificationController extends Controller
{
    public function index(): JsonResponse
    {
        $result = WineClassification::all();

        return $this->sendResponse($result, "Show all Wine Classifications");
    }
}
