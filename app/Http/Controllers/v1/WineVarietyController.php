<?php

namespace App\Http\Controllers\v1;

use App\Models\WineVariety;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class WineVarietyController extends Controller
{
    /**
     * @OA\Post (
     * path="/api/v1/wineVariety",
     * operationId="createWineVariety",
     * tags={"WineVariety"},
     * summary="Create WineVariety",
     * description="Create WineVariety in project",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"project_id", "title", "code"},
     *             @OA\Property(property="project_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="code", type="string"),
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
            WineVariety::PROJECT_ID => 'required|exists:App\Models\Project,id',
            WineVariety::TITLE => 'required|string',
            WineVariety::CODE => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $wineVariety = WineVariety::create($input);

        return $this->sendResponse($wineVariety, "WineVariety created");
    }

    /**
     * @OA\Put (
     * path="/api/v1/wineVariety/{wineVarietyId}",
     * operationId="updateWineVariety",
     * tags={"WineVariety"},
     * summary="Update WineVariety",
     * description="Update WineVariety in project",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"wine_variety_id"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="code", type="string"),
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
     * @param int $wineVarietyId
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, int $wineVarietyId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            WineVariety::TITLE => 'required|string',
            WineVariety::CODE => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        /** @property WineVariety $wineVariety */
        $wineVariety = WineVariety::findOrFail($wineVarietyId);

        $wineVariety->updateOrFail($input);

        $wineVariety->save();

        return $this->sendResponse($wineVariety, "WineVariety updated");
    }

    /**
     * @OA\Get  (
     * path="/api/v1/wineVariety/project/{projectId}",
     * operationId="getWineVarietyByProject",
     * tags={"WineVariety"},
     * summary="Get WineVariety By Project id",
     * description="Get WineVariety in project",
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
     * @throws Throwable
     */
    public function showByProject(int $projectId): JsonResponse
    {

        /** @property WineVariety $wineVariety */
        $wineVariety = WineVariety::whereProjectId($projectId);

        return $this->sendResponse($wineVariety->get(), "show WineVariety list by ProjectId");
    }
}
