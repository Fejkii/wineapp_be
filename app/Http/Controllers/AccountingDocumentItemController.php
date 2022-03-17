<?php

namespace App\Http\Controllers;

use App\Models\AccountingDocumentItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountingDocumentItemController extends Controller
{
    public function index(): JsonResponse
    {
        $result = AccountingDocumentItem::all();

        return $this->sendResponse($result, "Show all document items");
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            AccountingDocumentItem::ACCOUNTING_DOCUMENT_ID => 'required|exists:App\Models\AccountingDocument,id',
            AccountingDocumentItem::VAT_ID => 'required|integer|exists:App\Models\Vat,id',
            AccountingDocumentItem::TITLE => 'required|string',
            AccountingDocumentItem::COUNT => 'required|integer|min:0',
            AccountingDocumentItem::PRICE => 'required|numeric|min:0',
            AccountingDocumentItem::PRICE_CURRENCY => 'required|string',
        ]);

        if($validator->fails()) {
            return $this->sendError('Inputs are not valid.', 422);
        }


        $input = $request->all();
        $object = AccountingDocumentItem::create($input);

        return $this->sendResponse($object, "Document item created");
    }

    public function show(int $documentItemId): JsonResponse
    {
        $objects = AccountingDocumentItem::findOrFail($documentItemId);

        return $this->sendResponse($objects, "Show detail");
    }
}
