<?php

namespace App\Http\Controllers;

use App\Models\WineVariety;
use Illuminate\Http\JsonResponse;

class WineVarietyController extends Controller
{
    public function index(): JsonResponse
    {
        $result = WineVariety::all();

        return $this->sendResponse($result, "Show all Varieties");
    }
}
