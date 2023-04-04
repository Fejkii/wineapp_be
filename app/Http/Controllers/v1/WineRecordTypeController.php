<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\VineyardRecordTypeResource;
use App\Http\Resources\WineRecordTypeResource;
use App\Models\WineRecordType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WineRecordTypeController extends Controller
{
    /**
     * @OA\Get (
     * path="/api/v1/wineRecordType",
     * operationId="showWineRecordType",
     * tags={"WineRecordType"},
     * summary="Show all WineRecordTypes",
     * description="Show all WineRecordTypes",
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = WineRecordTypeResource::collection(WineRecordType::all());

        return $this->sendResponse($result, "Show all WineRecordTypes");
    }

    /**
     * @OA\Post (
     * path="/api/v1/wineRecordType",
     * operationId="createWineRecordType",
     * tags={"WineRecordType"},
     * summary="Create WineRecordType",
     * description="Create WineRecordType",
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
            WineRecordType::TITLE => 'required|string',
            WineRecordType::COLOR => 'string',
            WineRecordType::NOTE => 'string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $vineyard = WineRecordType::create($input);
        $result = VineyardRecordTypeResource::make($vineyard);

        return $this->sendResponse($result, "VineyardRecordType created");
    }
}
