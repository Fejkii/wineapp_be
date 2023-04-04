<?php declare(strict_types = 1);

namespace App\Http\Controllers\v1;

use App\Http\Resources\WineResource;
use App\Models\Wine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class WineController extends Controller
{
    /**
     * @OA\Post (
     * path="/api/v1/wine",
     * operationId="createWine",
     * tags={"Wine"},
     * summary="Create UserProject",
     * description="Create Wine in project with variety",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"project_id", "wine_variety_id", "title"},
     *             @OA\Property(property="project_id", type="integer", example=1),
     *             @OA\Property(property="wine_variety_id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Tramín 22"),
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
        $validator = Validator::make($request->all(), [
            Wine::PROJECT_ID => 'required|exists:App\Models\Project,id',
            Wine::WINE_VARIETY_ID => 'required|exists:App\Models\WineVariety,id',
            Wine::TITLE => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $input = $request->all();
        $wine = Wine::create($input);

        $result = WineResource::make($wine);

        return $this->sendResponse($result, "Wine created");
    }

    /**
     * @OA\Put (
     * path="/api/v1/wine/{wineId}",
     * operationId="updateWine",
     * tags={"Wine"},
     * summary="Update Wine",
     * description="Update Wine by selected wineId",
     *     @OA\Parameter(
     *         name="wineId",
     *         in="path",
     *         description="Wine ID",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={},
     *             @OA\Property(property="wine_variety_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
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
     * @param int $wineId
     * @return JsonResponse
     */
    public function update(Request $request, int $wineId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            Wine::WINE_VARIETY_ID => 'exists:App\Models\WineVariety,id',
            Wine::TITLE => 'string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        /** @property Wine $wine */
        $wine = Wine::findOrFail($wineId);

        $wine->wine_variety_id = $request[Wine::WINE_VARIETY_ID] ?? $wine->wine_variety_id;
        $wine->title = $request[Wine::TITLE] ?? $wine->title;

        $wine->save();
        $result = WineResource::make($wine);

        return $this->sendResponse($result, "Wine updated");
    }

    /**
     * @OA\Get(
     * path="/api/v1/wine/{wineId}",
     * operationId="showWineById",
     * tags={"Wine"},
     * summary="Show wine by wineId",
     * description="Show wine by wineId",
     *     @OA\Parameter(
     *         name="wineId",
     *         in="path",
     *         description="Wine ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $wineId
     * @return JsonResponse
     */
    public function show(int $wineId): JsonResponse
    {
        $wine = Wine::findOrFail($wineId);
        $result = WineResource::make($wine);

        return $this->sendResponse($result, "Show detail");
    }

    /**
     * @OA\Get(
     * path="/api/v1/wine/project/{projectId}",
     * operationId="showWineByProjectId",
     * tags={"Wine"},
     * summary="Show Wines by Project id",
     * description="Show Wines by Project id",
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
        $validator = Validator::make([$projectId], [
            $projectId => 'required|exists:App\Models\Project,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $wines = Wine::whereProjectId($projectId)->get();
        $result = WineResource::collection($wines);

        return $this->sendResponse($result, "Show Wines by Project id");
    }
}
