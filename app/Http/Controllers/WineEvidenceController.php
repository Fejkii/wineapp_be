<?php

namespace App\Http\Controllers;

use App\Models\WineEvidence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WineEvidenceController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->sendResponse(WineEvidence::all(), "Show all wine evidences");
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            WineEvidence::PROJECT_ID => 'required|exists:App\Models\Project,id',
            WineEvidence::WINE_ID => 'required|exists:App\Models\Wine,id',
            WineEvidence::TITLE => 'required|string',
            WineEvidence::VOLUME => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $input = $request->all();
        $object = WineEvidence::create($input);

        return $this->sendResponse($object, "Wine evidence created");
    }

    public function update(Request $request, int $wineEvidenceId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            WineEvidence::WINE_ID => 'exists:App\Models\Wine,id',
            WineEvidence::TITLE => 'string',
            WineEvidence::VOLUME => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        /** @property WineEvidence $wineEvidence */
        $wineEvidence = WineEvidence::findOrFail($wineEvidenceId);

        $wineEvidence->wine_id = $request[WineEvidence::WINE_ID] ?? $wineEvidence->wine_id;
        $wineEvidence->title = $request[WineEvidence::TITLE] ?? $wineEvidence->title;
        $wineEvidence->volume = $request[WineEvidence::VOLUME] ?? $wineEvidence->volume;

        $wineEvidence->save();

        return $this->sendResponse($wineEvidence, "Wine evidence updated");
    }

    public function show(int $wineEvidenceId): JsonResponse
    {
        $object = WineEvidence::findOrFail($wineEvidenceId);

        return $this->sendResponse($object, "Show detail");
    }
}
