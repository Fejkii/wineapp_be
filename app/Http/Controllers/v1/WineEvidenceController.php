<?php declare(strict_types = 1);

namespace App\Http\Controllers\v1;

use App\Http\Resources\WineEvidenceResource;
use App\Models\WineEvidence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;
use Throwable;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class WineEvidenceController extends Controller
{
    /**
     * @OA\Get (
     * path="/api/v1/wineEvidence",
     * operationId="showWineEvidence",
     * tags={"WineEvidence"},
     * summary="Show WineEvidences",
     * description="Show all WineEvidences",
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = WineEvidenceResource::collection(WineEvidence::all());

        return $this->sendResponse($result, "Show all wine evidences");
    }

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
     *             required={"project_id", "wine_id", "wine_classification_id", "title", "volume", "year"},
     *             @OA\Property(property="project_id", type="integer"),
     *             @OA\Property(property="wine_id", type="integer"),
     *             @OA\Property(property="wine_classification_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="volume", type="float"),
     *             @OA\Property(property="year", type="integer"),
     *             @OA\Property(property="alcohol", type="float"),
     *             @OA\Property(property="acid", type="float"),
     *             @OA\Property(property="sugar", type="float"),
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
            WineEvidence::WINE_ID => 'required|exists:App\Models\Wine,id',
            WineEvidence::WINE_CLASSIFICATION_ID => 'required|exists:App\Models\WineClassification,id',
            WineEvidence::TITLE => 'required|string',
            WineEvidence::VOLUME => 'required|numeric',
            WineEvidence::YEAR => 'required|numeric',
            WineEvidence::ALCOHOL => 'numeric|nullable',
            WineEvidence::ACID => 'numeric|nullable',
            WineEvidence::SUGAR => 'numeric|nullable',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $wineEvidence = WineEvidence::create($input);
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
     *             required={},
     *             @OA\Property(property="wine_id", type="integer"),
     *             @OA\Property(property="wine_classification_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="volume", type="float"),
     *             @OA\Property(property="year", type="integer"),
     *             @OA\Property(property="alcohol", type="float"),
     *             @OA\Property(property="acid", type="float"),
     *             @OA\Property(property="sugar", type="float"),
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
    public function update(Request $request, int $wineEvidenceId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            WineEvidence::WINE_ID => 'exists:App\Models\Wine,id',
            WineEvidence::WINE_CLASSIFICATION_ID => 'exists:App\Models\WineClassification,id',
            WineEvidence::TITLE => 'string',
            WineEvidence::VOLUME => 'numeric',
            WineEvidence::YEAR => 'numeric',
            WineEvidence::ALCOHOL => 'numeric|nullable',
            WineEvidence::ACID => 'numeric|nullable',
            WineEvidence::SUGAR => 'numeric|nullable',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
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
}