<?php

namespace App\Http\Controllers;

use App\Models\Wine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WineController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->sendResponse($result = Wine::all(), "Show all wines");
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            Wine::PROJECT_ID => 'required|exists:App\Models\Project,id',
            Wine::WINE_VARIETY_ID => 'required|exists:App\Models\WineVariety,id',
            Wine::WINE_CLASSIFICATION_ID => 'required|exists:App\Models\WineClassification,id',
            Wine::TITLE => 'required|string',
            Wine::YEAR => 'required|integer',
            Wine::ALCOHOL => 'numeric',
            Wine::ACID => 'numeric',
            Wine::SUGAR => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $input = $request->all();
        $wine = Wine::create($input);

        return $this->sendResponse($wine, "Wine created");
    }

    public function update(Request $request, int $wineId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            Wine::WINE_VARIETY_ID => 'exists:App\Models\WineVariety,id',
            Wine::WINE_CLASSIFICATION_ID => 'exists:App\Models\WineClassification,id',
            Wine::TITLE => 'string',
            Wine::YEAR => 'integer',
            Wine::ALCOHOL => 'numeric',
            Wine::ACID => 'numeric',
            Wine::SUGAR => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        /** @property Wine $wine */
        $wine = Wine::findOrFail($wineId);

        $wine->wine_variety_id = $request[Wine::WINE_VARIETY_ID] ?? $wine->wine_variety_id;
        $wine->wine_classification_id = $request[Wine::WINE_CLASSIFICATION_ID] ?? $wine->wine_classification_id;
        $wine->title = $request[Wine::TITLE] ?? $wine->title;
        $wine->year = $request[Wine::YEAR] ?? $wine->year;
        $wine->alcohol = $request[Wine::ALCOHOL] ?? $wine->alcohol;
        $wine->acid = $request[Wine::ACID] ?? $wine->acid;
        $wine->sugar = $request[Wine::SUGAR] ?? $wine->sugar;

        $wine->save();

        return $this->sendResponse($wine, "Wine updated");
    }

    public function show(int $wineId): JsonResponse
    {
        $objects = Wine::findOrFail($wineId);

        return $this->sendResponse($objects, "Show detail");
    }
}
