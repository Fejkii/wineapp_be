<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\WineRecordResource;
use App\Models\WineRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class WineRecordController extends Controller
{
    /**
     * @OA\Post (
     * path="/api/v1/wineRecord",
     * operationId="createWineRecord",
     * tags={"WineRecord"},
     * summary="Create WineRecord",
     * description="Create WineRecord",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"wine_evidence_id", "wine_record_type_id", "date"},
     *             @OA\Property(property="wine_evidence_id", type="integer"),
     *             @OA\Property(property="wine_record_type_id", type="integer"),
     *             @OA\Property(property="date", type="date"),
     *             @OA\Property(property="is_in_progress", type="boolean"),
     *             @OA\Property(property="date_to", type="date"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="data", type="string"),
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
            WineRecord::WINE_EVIDENCE_ID => 'required|exists:App\Models\WineEvidence,id',
            WineRecord::WINE_RECORD_TYPE_ID => 'required|exists:App\Models\WineRecordType,id',
            WineRecord::DATE => 'required|date',
            WineRecord::IS_IN_PROGRESS => 'nullable|boolean',
            WineRecord::DATE_TO => 'nullable|date',
            WineRecord::TITLE => 'nullable|string',
            WineRecord::DATA => 'nullable|string',
            WineRecord::NOTE => 'nullable|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $wineEvidence = WineRecord::create($input);
        $result = WineRecordResource::make($wineEvidence);

        return $this->sendResponse($result, "Wine record created");
    }

    /**
     * @OA\Put (
     * path="/api/v1/wineRecord/{wineRecordId}",
     * operationId="updateWineRecord",
     * tags={"WineRecord"},
     * summary="Update WineRecord",
     * description="Update WineRecord by selected wineRecordId",
     *     @OA\Parameter(
     *         name="wineRecordId",
     *         in="path",
     *         description="WineRecord ID",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"wine_evidence_id", "wine_record_type_id", "date"},
     *             @OA\Property(property="wine_evidence_id", type="integer"),
     *             @OA\Property(property="wine_record_type_id", type="integer"),
     *             @OA\Property(property="date", type="date"),
     *             @OA\Property(property="is_in_progress", type="boolean"),
     *             @OA\Property(property="date_to", type="date"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="data", type="string"),
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
     * @param int $wineRecordId
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, int $wineRecordId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            WineRecord::WINE_EVIDENCE_ID => 'exists:App\Models\WineEvidence,id',
            WineRecord::WINE_RECORD_TYPE_ID => 'exists:App\Models\WineRecordType,id',
            WineRecord::DATE => 'required|date',
            WineRecord::TITLE => 'nullable|string',
            WineRecord::DATA => 'nullable|string',
            WineRecord::NOTE => 'nullable|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        /** @property WineRecord $wineRecord */
        $wineEvidence = WineRecord::findOrFail($wineRecordId);

        $wineEvidence->updateOrFail($input);

        $wineEvidence->save();
        $result = WineRecordResource::make($wineEvidence);

        return $this->sendResponse($result, "WineRecord updated");
    }

    /**
     * @OA\Get(
     * path="/api/v1/wineRecord/{wineRecordId}",
     * operationId="showWineRecordById",
     * tags={"WineRecord"},
     * summary="Show wineRecord by wineRecordId",
     * description="Show wineRecord by wineRecordId",
     *     @OA\Parameter(
     *         name="wineRecordId",
     *         in="path",
     *         description="WineRecord ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $wineRecordId
     * @return JsonResponse
     */
    public function show(int $wineRecordId): JsonResponse
    {
        $wineRecord = WineRecord::findOrFail($wineRecordId);
        $result = WineRecordResource::make($wineRecord);

        return $this->sendResponse($result, "Show detail");
    }

    /**
     * @OA\Get(
     * path="/api/v1/wineRecord/wineEvidence/{wineEvidenceId}",
     * operationId="showWineRecordByWineEvidenceId",
     * tags={"WineRecord"},
     * summary="Show wineRecord list by wineEvidenceId",
     * description="Show wineRecord list by wineEvidenceId",
     *     @OA\Parameter(
     *         name="wineEvidenceId",
     *         in="path",
     *         description="WineEvidence ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $wineEvidenceId
     * @return JsonResponse
     */
    public function showByWineEvidence(int $wineEvidenceId): JsonResponse
    {
        $wineRecord = WineRecord::whereWineEvidenceId($wineEvidenceId);
        $result = WineRecordResource::collection($wineRecord->get()->sortByDesc(WineRecord::DATE));

        return $this->sendResponse($result, "Show WineRecord List for wineEvidence");
    }
}
