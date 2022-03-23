<?php

namespace App\Http\Controllers;

use App\Models\AccountingCompany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountingCompanyController extends Controller
{
    public function index(): JsonResponse
    {
        $result["companies"] = AccountingCompany::all();

        return $this->sendResponse($result, "Show all companies");
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            AccountingCompany::PROJECT_ID => 'required|integer|exists:App\Models\Project,id',
            AccountingCompany::COUNTRY_ID => 'required|integer|exists:App\Models\Country,id',
            AccountingCompany::TITLE => 'required|string|unique:accounting_companies',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $input = $request->all();
        $company = AccountingCompany::create($input);

        return $this->sendResponse($company, "Company created");
    }

    public function show(int $companyId): JsonResponse
    {
        $companies = AccountingCompany::findOrFail($companyId);

        return $this->sendResponse($companies, "Show detail");
    }
}
