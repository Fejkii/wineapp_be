<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function index(): JsonResponse
    {
        $result = Country::all();

        return $this->sendResponse($result, "Show all Countries");
    }
}
