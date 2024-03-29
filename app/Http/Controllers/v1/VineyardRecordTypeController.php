<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\VineyardRecordTypeResource;
use App\Models\VineyardRecordType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VineyardRecordTypeController extends Controller
{
    /**
     * @OA\Get (
     * path="/api/v1/vineyardRecordType",
     * operationId="showVineyardRecordType",
     * tags={"VineyardRecordType"},
     * summary="Show all VineyardRecordTypes",
     * description="Show all VineyardRecordTypes",
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = VineyardRecordTypeResource::collection(VineyardRecordType::all());

        return $this->sendResponse($result, "Show all VineyardRecordTypes");
    }

    /**
     * @OA\Post (
     * path="/api/v1/vineyardRecordType",
     * operationId="createVineyardRecordType",
     * tags={"VineyardRecordType"},
     * summary="Create VineyardRecordType",
     * description="Create VineyardRecordType",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"title"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="color", type="string"),
     *             @OA\Property(property="note", type="string"),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            VineyardRecordType::TITLE => 'required|string',
            VineyardRecordType::COLOR => 'string',
            VineyardRecordType::NOTE => 'string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $vineyard = VineyardRecordType::create($input);
        $result = VineyardRecordTypeResource::make($vineyard);

        return $this->sendResponse($result, "VineyardRecordType created");
    }
}
