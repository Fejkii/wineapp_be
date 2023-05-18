<?php declare(strict_types = 1);

namespace App\Http\Controllers\v1;

use App\Http\Resources\WineEvidenceResource;
use App\Models\WineEvidence;
use App\Models\WineEvidenceWine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class WineEvidenceController extends Controller
{
    /**
     * @OA\Post (
     * path="/api/v1/wineEvidence",
     * operationId="createWineEvidence",
     * tags={"WineEvidence"},
     * summary="Create WineEvidence",
     * description="Create WineEvidence in project",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"project_id", "wines", "title", "volume", "year"},
     *             @OA\Property(property="project_id", type="integer"),
     *             @OA\Property(property="wines", type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="wine_classification_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="volume", type="double"),
     *             @OA\Property(property="year", type="integer"),
     *             @OA\Property(property="alcohol", type="double"),
     *             @OA\Property(property="acid", type="double"),
     *             @OA\Property(property="sugar", type="double"),
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
            WineEvidence::PROJECT_ID => 'required|exists:App\Models\Project,id',
            WineEvidence::WINES => 'required|array',
            WineEvidence::WINE_CLASSIFICATION_ID => 'nullable|exists:App\Models\WineClassification,id',
            WineEvidence::TITLE => 'required|string',
            WineEvidence::VOLUME => 'required|numeric',
            WineEvidence::YEAR => 'required|numeric',
            WineEvidence::ALCOHOL => 'nullable|numeric',
            WineEvidence::ACID => 'nullable|numeric',
            WineEvidence::SUGAR => 'nullable|numeric',
            WineEvidence::NOTE => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Inputs are not valid.' . $validator->messages(), 422);
        }

        $wineEvidence = WineEvidence::create([
            WineEvidence::PROJECT_ID => $request[WineEvidence::PROJECT_ID],
            WineEvidence::WINE_CLASSIFICATION_ID => $request[WineEvidence::WINE_CLASSIFICATION_ID],
            WineEvidence::TITLE => $request[WineEvidence::TITLE],
            WineEvidence::VOLUME => $request[WineEvidence::VOLUME],
            WineEvidence::YEAR => $request[WineEvidence::YEAR],
            WineEvidence::ALCOHOL => $request[WineEvidence::ALCOHOL],
        ]);

        $wineEvidence->save();

        foreach ($input[WineEvidence::WINES] as $wineId) {
            WineEvidenceWine::create([
                WineEvidenceWine::WINE_EVIDENCE_ID => $wineEvidence->id,
                WineEvidenceWine::WINE_ID => $wineId,
            ]);
        }

        $result = WineEvidenceResource::make($wineEvidence);

        return $this->sendResponse($result, "Wine evidence created");
    }

    /**
     * @OA\Put (
     * path="/api/v1/wineEvidence/{wineEvidenceId}",
     * operationId="updateWineEvidence",
     * tags={"WineEvidence"},
     * summary="Update WineEvidence",
     * description="Update WineEvidence by selected wineEvidenceId",
     *     @OA\Parameter(
     *         name="wineEvidenceId",
     *         in="path",
     *         description="WineEvidence ID",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"wines", "title", "volume", "year"},
     *             @OA\Property(property="wines", type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="wine_classification_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="volume", type="double"),
     *             @OA\Property(property="year", type="integer"),
     *             @OA\Property(property="alcohol", type="double"),
     *             @OA\Property(property="acid", type="double"),
     *             @OA\Property(property="sugar", type="double"),
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
     * @param int $wine+EvidenceId
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, int $wineEvidenceId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            WineEvidence::WINES => 'required|array',
            WineEvidence::WINE_CLASSIFICATION_ID => 'nullable|exists:App\Models\WineClassification,id',
            WineEvidence::TITLE => 'required|string',
            WineEvidence::VOLUME => 'required|numeric',
            WineEvidence::YEAR => 'required|numeric',
            WineEvidence::ALCOHOL => 'nullable|numeric',
            WineEvidence::ACID => 'nullable|numeric',
            WineEvidence::SUGAR => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        /** @property WineEvidence $wineEvidence */
        $wineEvidence = WineEvidence::findOrFail($wineEvidenceId);

        $wineEvidence->updateOrFail($input);

        $wineEvidence->save();
        $result = WineEvidenceResource::make($wineEvidence);

        return $this->sendResponse($result, "Wine evidence updated");
    }
    /**
     * @OA\Put (
     * path="/api/v1/wineEvidence/volume/{wineEvidenceId}",
     * operationId="updateWineEvidenceVolume",
     * tags={"WineEvidence"},
     * summary="Update WineEvidence volume",
     * description="Update WineEvidence volume by selected wineEvidenceId",
     *     @OA\Parameter(
     *         name="wineEvidenceId",
     *         in="path",
     *         description="WineEvidence ID",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"volume"},
     *             @OA\Property(property="volume", type="double"),
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
     * @param int $wineEvidenceId
     * @return JsonResponse
     * @throws Throwable
     */
    public function updateVolume(Request $request, int $wineEvidenceId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            WineEvidence::VOLUME => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        /** @property WineEvidence $wineEvidence */
        $wineEvidence = WineEvidence::findOrFail($wineEvidenceId);

        $wineEvidence->updateOrFail($input);

        $wineEvidence->save();
        $result = WineEvidenceResource::make($wineEvidence);

        return $this->sendResponse($result, "Wine evidence updated");
    }

    /**
     * @OA\Get(
     * path="/api/v1/wineEvidence/{wineEvidenceId}",
     * operationId="showWineEvidenceById",
     * tags={"WineEvidence"},
     * summary="Show wine by wineEvidenceId",
     * description="Show wine by wineEvidenceId",
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
    public function show(int $wineEvidenceId): JsonResponse
    {
        $wineEvidence = WineEvidence::findOrFail($wineEvidenceId);
        $result = WineEvidenceResource::make($wineEvidence);

        return $this->sendResponse($result, "Show detail");
    }

    /**
     * @OA\Get(
     * path="/api/v1/wineEvidence/project/{projectId}",
     * operationId="showWineEvidencesByProjectId",
     * tags={"WineEvidence"},
     * summary="Show WineEvidences by ProjectId",
     * description="Show WineEvidences by ProjectId",
     *     @OA\Parameter(
     *         name="projectId",
     *         in="path",
     *         description="Project ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $projectId
     * @return JsonResponse
     */
    public function showByProject(int $projectId): JsonResponse
    {
        $wineEvidence = WineEvidence::whereProjectId($projectId);
        $result = WineEvidenceResource::collection($wineEvidence->get());

        return $this->sendResponse($result, "Show WineEvidences by ProjectId");
    }
}
