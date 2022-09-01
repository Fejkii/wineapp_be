<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\UserProjectResource;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/v1/userProjects",
     * operationId="userProjects",
     * tags={"User"},
     * summary="Show user projects",
     * description="Show projects for logged in user",
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function showUserProjects(Request $request): JsonResponse
    {
        $userProjects = UserProject::whereUserId($request->user()->id)->paginate();

        UserProjectResource::collection($userProjects);

        return $this->sendResponse($userProjects, "Show projects for logged user");
    }

    /**
     * @OA\Get(
     * path="/api/v1/projectUsers/{projectId}",
     * operationId="projectUsers",
     * tags={"User"},
     * summary="Show project users",
     * description="Show users for selected project",
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function showProjectUsers(int $projectId): JsonResponse
    {
        $validator = Validator::make([$projectId], [
            $projectId => 'required|integer|exists:projects,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Project is not valid.', 422);
        }

        $userProjects = UserProject::whereProjectId($projectId)->get();

        $result = UserProjectResource::collection($userProjects);

        return $this->sendResponse($result, "Show users for selected project");
    }

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
     */
    public function show(Request $request): JsonResponse
    {
        return $this->sendResponse($request->user(), "Show logged in user");
    }
}
