<?php

namespace App\Http\Controllers;

use App\Models\Vineyard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class VineyardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            Vineyard::PROJECT_ID => 'required|exists:App\Models\Project,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $vineyards = Vineyard::whereProjectId($input[Vineyard::PROJECT_ID])->get();

        $result = [
            "vineyards" => $vineyards,
            Response::HTT
        ];

        return $this->sendResponse($result, "Show all Vineyards");
    }

    public function create(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            Vineyard::PROJECT_ID => 'required|exists:App\Models\Project,id',
            Vineyard::TITLE => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $vineyard = Vineyard::create($input);

        $result = [
            "vineyard" => $vineyard,
        ];

        return $this->sendResponse($result, "Vineyard created");
    }

    public function update(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            Vineyard::ID => 'required|exists:App\Models\Vineyard,id',
            Vineyard::TITLE => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $vineyard = Vineyard::findOrFail($input[Vineyard::ID]);

        $vineyard->updateOrFail($input);

        $result = [
            "vineyard" => $vineyard,
        ];

        return $this->sendResponse($result, "Vineyard updated");
    }
}
