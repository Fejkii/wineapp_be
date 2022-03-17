<?php

namespace App\Http\Controllers;

use App\Models\AccountingDocumentPaymentState;
use Illuminate\Http\JsonResponse;

class AccountingDocumentPaymentStateController extends Controller
{
    public function index(): JsonResponse
    {
        $result = AccountingDocumentPaymentState::all();

        return $this->sendResponse($result, "Show all Payment States");
    }
}
