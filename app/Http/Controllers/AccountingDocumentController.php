<?php

namespace App\Http\Controllers;

use App\Models\AccountingDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountingDocumentController extends Controller
{
    public function index(): JsonResponse
    {
        $result = AccountingDocument::all();

        return $this->sendResponse($result, "Show all documents");
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            AccountingDocument::PROJECT_ID => 'required|exists:App\Models\Project,id',
            AccountingDocument::COMPANY_ID => 'required|exists:App\Models\AccountingCompany,id',
            AccountingDocument::PAYMENT_TYPE_ID => 'required|exists:App\Models\AccountingPaymentType,id',
            AccountingDocument::USER_ID => 'required|exists:App\Models\User,id',
            AccountingDocument::DOCUMENT_TYPE_ID => 'required|exists:App\Models\AccountingDocumentType,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }


        $input = $request->all();
        $object = AccountingDocument::create($input);

        return $this->sendResponse($object, "Document created");
    }

    public function show(int $documentId): JsonResponse
    {
        $objects = AccountingDocument::findOrFail($documentId);

        return $this->sendResponse($objects, "Show detail");
    }
}
