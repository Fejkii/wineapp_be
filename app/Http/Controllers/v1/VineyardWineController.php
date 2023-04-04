<?php declare(strict_types = 1);

namespace App\Http\Controllers\v1;

use App\Http\Resources\VineyardWineResource;
use App\Models\VineyardWine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class VineyardWineController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/v1/vineyardWine/{vineyardWineId}",
     * operationId="showVineyardWineById",
     * tags={"VineyardWine"},
     * summary="Show vineyard by vineyardWineId",
     * description="Show vineyard by vineyardWineId",
     *     @OA\Parameter(
     *         name="vineyardWineId",
     *         in="path",
     *         description="VineyardWine ID",
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
    public function show(int $vineyardWineId): JsonResponse
    {
        $vineyardWine = VineyardWine::findOrFail($vineyardWineId);

        $result = VineyardWineResource::make($vineyardWine);

        return $this->sendResponse($result, "Show VineyardWine by vineyardWineId");
    }

    /**
     * @OA\Post (
     * path="/api/v1/vineyardWine",
     * operationId="createVineyardWine",
     * tags={"VineyardWine"},
     * summary="Create VineyardWine",
     * description="Create VineyardWine",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"vineyard_id", "wine_id", "title", "quantity"},
     *             @OA\Property(property="vineyard_id", type="integer"),
     *             @OA\Property(property="wine_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="quantity", type="integer"),
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
            VineyardWine::VINEYARD_ID => 'required|exists:App\Models\Vineyard,id',
            VineyardWine::WINE_ID => 'required|exists:App\Models\Wine,id',
            VineyardWine::TITLE => 'required|string',
            VineyardWine::QUANTITY => 'required|integer',
            VineyardWine::NOTE => 'string|nullable',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $vineyardWine = VineyardWine::create($input);
        $result = VineyardWineResource::make($vineyardWine);

        return $this->sendResponse($result, "VineyardWine created");
    }

    /**
     * @OA\Put (
     * path="/api/v1/vineyardWine/{vineyardWineId}",
     * operationId="updateVineyardWine",
     * tags={"VineyardWine"},
     * summary="Update VineyardWine",
     * description="Update VineyardWine by selected vineyardWineId",
     *     @OA\Parameter(
     *         name="vineyardWineId",
     *         in="path",
     *         description="VineyardWine ID",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={},
     *             @OA\Property(property="vineyard_id", type="integer"),
     *             @OA\Property(property="wine_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="quantity", type="integer"),
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
     * @param int $vineyardWineId
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, int $vineyardWineId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            VineyardWine::VINEYARD_ID => 'exists:App\Models\Vineyard,id',
            VineyardWine::WINE_ID => 'exists:App\Models\Wine,id',
            VineyardWine::TITLE => 'string',
            VineyardWine::QUANTITY => 'integer',
            VineyardWine::NOTE => 'string|nullable',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $vineyardWine = VineyardWine::findOrFail($vineyardWineId);

        $vineyardWine->updateOrFail($input);
        $result = VineyardWineResource::make($vineyardWine);

        return $this->sendResponse($result, "VineyardWine updated");
    }

    /**
     * @OA\Get(
     * path="/api/v1/vineyardWine/vineyard/{vineyardId}",
     * operationId="showVineyardWinesByVineyardId",
     * tags={"VineyardWine"},
     * summary="Show vineyardWines by vineyardId",
     * description="Show vineyardWines by vineyardId",
     *     @OA\Parameter(
     *         name="vineyardId",
     *         in="path",
     *         description="Vineyard ID",
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
            return $this->sendError('Validation error: ' . $validator->errors(), 422);
        }

        $vineyards = VineyardWine::whereVineyardId($vineyardId);
        $count = $vineyards->count('wine_id');
        $sum = (int)$vineyards->sum('quantity');
        $result = [
            "data" => VineyardWineResource::collection($vineyards->get()),
            "count" => $count,
            "sum" => $sum,
        ];

        return $this->sendResponse($result, "Show VineyardWines by VineyardId");
    }
}
