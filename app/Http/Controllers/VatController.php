<?php

namespace App\Http\Controllers;

use App\Models\Vat;
use Illuminate\Http\JsonResponse;

class VatController extends Controller
{
    public function index(): JsonResponse
    {
        $result = Vat::all();

        return $this->sendResponse($result, "Show all Vats");
    }
}
