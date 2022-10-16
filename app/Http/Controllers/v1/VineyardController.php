<?php declare(strict_types = 1);

namespace App\Http\Controllers\v1;

use App\Http\Resources\VineyardResource;
use App\Models\Vineyard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;
use Throwable;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class VineyardController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/v1/vineyard/{vineyardId}",
     * operationId="showVineyardById",
     * tags={"Vineyard"},
     * summary="Show vineyard by vineyardId",
     * description="Show vineyard by vineyardId",
     *     @OA\Parameter(
     *         name="vineyardId",
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
     * @param int $vineyardId
     * @return JsonResponse
     */
    public function show(int $vineyardId): JsonResponse
    {
        $validator = Validator::make([$vineyardId], [
            $vineyardId => 'required|exists:App\Models\Vineyard,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $vineyard = Vineyard::findOrFail($vineyardId);

        $result = VineyardResource::make($vineyard);

        return $this->sendResponse($result, "Show all Vineyards");
    }

    /**
     * @OA\Get(
     * path="/api/v1/vineyardList/{projectId}",
     * operationId="showVineyardsByProjectId",
     * tags={"Vineyard"},
     * summary="Show vineyards by projectId",
     * description="Show vineyards by projectId",
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
            return $this->sendError('Inputs are not valid.', 422);
        }

        $vineyards = Vineyard::whereProjectId($projectId)->get();

        $result = VineyardResource::collection($vineyards);

        return $this->sendResponse($result, "Show all Vineyards");
    }

    /**
     * @OA\Post (
     * path="/api/v1/vineyard",
     * operationId="createVineyard",
     * tags={"Vineyard"},
     * summary="Create Vineyard",
     * description="Create Vineyard in project",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"project_id", "title"},
     *             @OA\Property(property="project_id", type="integer"),
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
     * @return JsonResponse
     */
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
        $result = VineyardResource::make($vineyard);

        return $this->sendResponse($result, "Vineyard created");
    }

    /**
     * @OA\Put (
     * path="/api/v1/vineyard/{vineyardId}",
     * operationId="updateVineyard",
     * tags={"Vineyard"},
     * summary="Update Vineyard",
     * description="Update Vineyard by selected vineyardId",
     *     @OA\Parameter(
     *         name="vineyardId",
     *         in="path",
     *         description="Vineyard ID",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={},
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
     * @param int $vineyardId
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, int $vineyardId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            Vineyard::TITLE => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $vineyard = Vineyard::findOrFail($vineyardId);

        $vineyard->updateOrFail($input);
        $result = VineyardResource::make($vineyard);

        return $this->sendResponse($result, "Vineyard updated");
    }
}
