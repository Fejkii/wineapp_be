<?php

namespace App\Http\Controllers;

use App\Models\AccountingDocumentType;
use Illuminate\Http\JsonResponse;

class AccountingDocumentTypeController extends Controller
{
    public function index(): JsonResponse
    {
        $result = AccountingDocumentType::all();

        return $this->sendResponse($result, "Show all DocumentTypes");
    }
}
