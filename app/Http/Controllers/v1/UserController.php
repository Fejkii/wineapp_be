<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;
use Throwable;

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

    /**
     * @OA\Put (
     * path="/api/v1/user/{userId}",
     * operationId="updateUser",
     * tags={"User"},
     * summary="Update User",
     * description="Update User by selected userId",
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
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
     * @param int $userId
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Request $request, int $userId): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            User::NAME => 'required|string|max:100',
            User::EMAIL => 'required|string|email|max:255',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $user = User::findOrFail($userId);

        $user->updateOrFail($input);
        $result = UserResource::make($user);

        return $this->sendResponse($result, "User updated");
    }
}
