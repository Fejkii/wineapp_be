<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/v1/user",
     * operationId="user",
     * tags={"User"},
     * summary="Show logged in user",
     * description="Show actual logged in user",
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
    public function show(Request $request): JsonResponse
    {
        return $this->sendResponse($request->user(), "Show logged in user");
    }
}
