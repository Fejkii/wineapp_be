<?php

namespace App\Http\Controllers\v1;

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
     *             required={"vineyard_record_type_id", "date"},
     *             @OA\Property(property="vineyard_id", type="integer"),
     *             @OA\Property(property="vineyard_wine_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="data", type="string"),
     *             @OA\Property(property="date", type="date"),
     *             @OA\Property(property="is_in_progress", type="boolean"),
     *             @OA\Property(property="date_to", type="date"),
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
            VineyardRecord::DATE => 'required|date',
            VineyardRecord::IS_IN_PROGRESS => 'nullable|boolean',
            VineyardRecord::DATE_TO => 'nullable|date',
            VineyardRecord::TITLE => 'nullable|string',
            VineyardRecord::DATA => 'nullable|string',
            VineyardRecord::VINEYARD_ID => 'nullable|exists:App\Models\Vineyard,id',
            VineyardRecord::VINEYARD_WINE_ID => 'nullable|exists:App\Models\VineyardWine,id',
            VineyardRecord::NOTE => 'nullable|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $vineyardRecord = VineyardRecord::create($input);
        $result = VineyardRecordResource::make($vineyardRecord);

        return $this->sendResponse($result, "VineyardRecord created");
    }

    /**
     * @OA\Put (
     * path="/api/v1/vineyardRecord/{vineyardRecordId}",
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
     *             required={"vineyard_record_type_id", "date"},
     *             @OA\Property(property="vineyard_id", type="integer"),
     *             @OA\Property(property="vineyard_wine_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="data", type="string"),
     *             @OA\Property(property="date", type="date"),
     *             @OA\Property(property="is_in_progress", type="boolean"),
     *             @OA\Property(property="date_to", type="date"),
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
            VineyardRecord::VINEYARD_RECORD_TYPE_ID => 'required|exists:App\Models\VineyardRecordType,id',
            VineyardRecord::DATE => 'required|date',
            VineyardRecord::IS_IN_PROGRESS => 'nullable|boolean',
            VineyardRecord::DATE_TO => 'nullable|date',
            VineyardRecord::TITLE => 'nullable|string',
            VineyardRecord::DATA => 'nullable|string',
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
        $vineyardRecord = VineyardRecord::findOrFail($vineyardRecordId);
        $result = VineyardRecordResource::make($vineyardRecord);

        return $this->sendResponse($result, "Show detail");
    }

    /**
     * @OA\Get(
     * path="/api/v1/vineyardRecord/vineyard/{vineyardId}",
     * operationId="showVineyardRecordByVineyardId",
     * tags={"VineyardRecord"},
     * summary="Show VineyardRecords by vineyardId",
     * description="Show VineyardRecords by vineyardId",
     *     @OA\Parameter(
     *         name="VineyardId",
     *         in="path",
     *         description="VineyardId ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $vineyardId
     * @return JsonResponse
     */
    public function showByVineyard(int $vineyardId): JsonResponse
    {
        $validator = Validator::make([$vineyardId], [
            $vineyardId => 'required|exists:App\Models\Vineyard,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $wineRecord = VineyardRecord::whereVineyardId($vineyardId);
        $result = VineyardRecordResource::collection($wineRecord->get()->sortByDesc(VineyardRecord::DATE));

        return $this->sendResponse($result, "Show VineyardRecords by VineyardId");
    }

    /**
     * @OA\Get(
     * path="/api/v1/vineyardRecord/vineyardWine/{vineyardWineId}",
     * operationId="showVineyardRecordByVineyardWineId",
     * tags={"VineyardRecord"},
     * summary="Show VineyardRecords by vineyardWineId",
     * description="Show VineyardRecords by vineyardWineId",
     *     @OA\Parameter(
     *         name="vineyardWineId",
     *         in="path",
     *         description="VineyardId ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $vineyardWineId
     * @return JsonResponse
     */
    public function showByVineyardWine(int $vineyardWineId): JsonResponse
    {
        $validator = Validator::make([$vineyardWineId], [
            $vineyardWineId => 'required|exists:App\Models\VineyardWine,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $wineRecord = VineyardRecord::whereVineyardWineId($vineyardWineId);
        $result = VineyardRecordResource::make($wineRecord->get()->sortByDesc(VineyardRecord::DATE));

        return $this->sendResponse($result, "Show VineyardRecords by VineyardWineId");
    }
}
