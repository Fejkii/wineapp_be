<?php

namespace App\Http\Controllers;

use App\Models\AccountingPaymentType;
use Illuminate\Http\JsonResponse;

class AccountingPaymentTypeController extends Controller
{
    public function index(): JsonResponse
    {
        $result = AccountingPaymentType::all();

        return $this->sendResponse($result, "Show all PaymentTypes");
    }
}
