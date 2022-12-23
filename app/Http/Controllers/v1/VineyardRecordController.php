<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\VineyardRecordResource;
use App\Models\VineyardRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class VineyardRecordController extends Controller
{
    /**
     * @OA\Post (
     * path="/api/v1/vineyardRecord",
     * operationId="createVineyardRecord",
     * tags={"VineyardRecord"},
     * summary="Create VineyardRecord",
     * description="Create VineyardRecord",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"wine_evidence_id", "wine_record_type_id", "title", "date"},
     *             @OA\Property(property="wine_evidence_id", type="integer"),
     *             @OA\Property(property="wine_record_type_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="date", type="string"),
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
            VineyardRecord::VINEYARD_RECORD_TYPE_ID => 'required|exists:App\Models\VineyardRecordType,id',
            VineyardRecord::TITLE => 'required|string',
            VineyardRecord::DATE => 'required|string',
            VineyardRecord::VINEYARD_ID => 'nullable|exists:App\Models\Vineyard,id',
            VineyardRecord::VINEYARD_WINE_ID => 'nullable|exists:App\Models\VineyardWine,id',
            VineyardRecord::NOTE => 'nullable|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $wineEvidence = VineyardRecord::create($input);
        $result = VineyardRecordResource::make($wineEvidence);

        return $this->sendResponse($result, "VineyardRecord created");
    }

    /**
     * @OA\Put (
     * path="/api/v1/wineRecord/{vineyardRecordId}",
     * operationId="updateVineyardRecord",
     * tags={"VineyardRecord"},
     * summary="Update VineyardRecord",
     * description="Update VineyardRecord by selected vineyardRecordId",
     *     @OA\Parameter(
     *         name="vineyardRecordId",
     *         in="path",
     *         description="VineyardRecord ID",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={},
     *             @OA\Property(property="wine_evidence_id", type="integer"),
     *             @OA\Property(property="wine_record_type_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="date", type="string"),
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
     * @param int $vineyardRecordId
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, int $vineyardRecordId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            VineyardRecord::VINEYARD_RECORD_TYPE_ID => 'exists:App\Models\VineyardRecordType,id',
            VineyardRecord::TITLE => 'string',
            VineyardRecord::DATE => 'string',
            VineyardRecord::VINEYARD_ID => 'nullable|exists:App\Models\Vineyard,id',
            VineyardRecord::VINEYARD_WINE_ID => 'nullable|exists:App\Models\VineyardWine,id',
            VineyardRecord::NOTE => 'nullable|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        /** @property VineyardRecord $vineyardRecord */
        $vineyardRecord = VineyardRecord::findOrFail($vineyardRecordId);

        $vineyardRecord->updateOrFail($input);

        $vineyardRecord->save();
        $result = VineyardRecordResource::make($vineyardRecord);

        return $this->sendResponse($result, "VineyardRecord updated");
    }

    /**
     * @OA\Get(
     * path="/api/v1/vineyardRecord/{vineyardRecordId}",
     * operationId="showVineyardRecordById",
     * tags={"VineyardRecord"},
     * summary="Show VineyardRecord by vineyardRecordId",
     * description="Show VineyardRecord by vineyardRecordId",
     *     @OA\Parameter(
     *         name="vineyardRecordId",
     *         in="path",
     *         description="VineyardRecord ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $vineyardRecordId
     * @return JsonResponse
     */
    public function show(int $vineyardRecordId): JsonResponse
    {
        $wineRecord = VineyardRecord::findOrFail($vineyardRecordId);
        $result = VineyardRecordResource::make($wineRecord);

        return $this->sendResponse($result, "Show detail");
    }
}
