<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\UserProjectResource;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class UserProjectController extends Controller
{
    /**
     * @OA\Post (
     * path="/api/v1/userProject",
     * operationId="createUserProject",
     * tags={"UserProject"},
     * summary="Create UserProject",
     * description="Add user to selected project, that create new UserProject",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "project_id"},
     *             @OA\Property(property="email", type="email", example="petr@test.cz"),
     *             @OA\Property(property="project_id", type="integer", example=1),
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
            User::EMAIL => 'required|string|email|max:255',
            UserProject::PROJECT_ID => 'required|integer|exists:projects,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Email or Project is not valid.', 422);
        }

        $user = User::whereEmail($input[User::EMAIL])->first();
        if ($user == null) {
            return  $this->sendError('User must be register first');
        }

        // check the user if already has this project
        $userProject = UserProject::whereUserId($user->id)->where(UserProject::PROJECT_ID, "=", $input[UserProject::PROJECT_ID])->first();

        if ($userProject != null) {
            return $this->sendError('User already has this project', 409);
        }

        $isDefault = true;
        if ($user->has('userProjects')) {
            $isDefault = false;
        }

        $userProjectValues = [
            UserProject::USER_ID => $user->id,
            UserProject::PROJECT_ID => $input[UserProject::PROJECT_ID],
            UserProject::IS_DEFAULT => $isDefault,
        ];

        $userProject = UserProject::create($userProjectValues);

        $result = UserProjectResource::make($userProject);

        return $this->sendResponse($result, "User added to this Project and UserProject created");
    }

    /**
     * @OA\Get (
     * path="/api/v1/userProject/{userProjectId}",
     * operationId="showUserProjectById",
     * tags={"UserProject"},
     * summary="Show UserProject by userProjectId",
     * description="Show UserProject",
     *     @OA\Parameter(
     *         name="userProjectId",
     *         in="path",
     *         description="UserProject ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $userProjectId
     * @return JsonResponse
     */
    public function show(int $userProjectId): JsonResponse
    {
        $validator = Validator::make([$userProjectId], [
            $userProjectId => 'nullable|integer|exists:user_projects,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $userProject = UserProject::findOrFail($userProjectId);

        $result = UserProjectResource::make($userProject);

        return $this->sendResponse($result, "Show UserProject");
    }

    /**
     * @OA\Get (
     * path="/api/v1/userProject",
     * operationId="showUserProjectByParams",
     * tags={"UserProject"},
     * summary="Show UserProject by parameters",
     * description="Show UserProject",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="UserProject ID",
     *         required=false,
     *      ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="Users ID",
     *         required=false,
     *      ),
     *     @OA\Parameter(
     *         name="project_id",
     *         in="query",
     *         description="Project ID",
     *         required=false,
     *      ),
     *     @OA\Parameter(
     *         name="is_default",
     *         in="query",
     *         description="isDefault Project",
     *         required=false,
     *      ),
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
    public function showByParams(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            UserProject::ID => 'nullable|integer|exists:user_projects,id',
            UserProject::USER_ID => 'nullable|integer|exists:users,id',
            UserProject::PROJECT_ID => 'nullable|integer|exists:projects,id',
            UserProject::IS_DEFAULT => 'nullable|boolean',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $userProject = UserProject::select();

        if ($request->filled(UserProject::ID)) {
            $userProject->where(UserProject::ID, "=", $request->id);
        }
        if ($request->filled(UserProject::USER_ID)) {
            $userProject->where(UserProject::USER_ID, "=", $request->user_id);
        }
        if ($request->filled(UserProject::PROJECT_ID)) {
            $userProject->where(UserProject::PROJECT_ID, "=", $request->project_id);
        }
        if ($request->filled(UserProject::IS_DEFAULT)) {
            $userProject->where(UserProject::IS_DEFAULT, "=", $request->is_default);
        }

        $result = null;
        $userProject = $userProject->first();

        if ($userProject !== null) {
            $result = UserProjectResource::make($userProject);
        }

        return $this->sendResponse($result, "Show UserProject by params");
    }

    /**
     * @OA\Get (
     * path="/api/v1/userProject/list",
     * operationId="showListByParams",
     * tags={"UserProject"},
     * summary="Show UserProject list by parameters",
     * description="Show UserProject list",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="UserProject ID",
     *         required=false,
     *      ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="Users ID",
     *         required=false,
     *      ),
     *     @OA\Parameter(
     *         name="project_id",
     *         in="query",
     *         description="Project ID",
     *         required=false,
     *      ),
     *     @OA\Parameter(
     *         name="is_default",
     *         in="query",
     *         description="isDefault Project",
     *         required=false,
     *      ),
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
    public function showListByParams(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            UserProject::ID => 'nullable|integer|exists:user_projects,id',
            UserProject::USER_ID => 'nullable|integer|exists:users,id',
            UserProject::PROJECT_ID => 'nullable|integer|exists:projects,id',
            UserProject::IS_DEFAULT => 'nullable|boolean',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $userProjects = UserProject::select();

        if ($request->filled(UserProject::ID)) {
            $userProjects->where(UserProject::ID, "=", $request->id);
        }
        if ($request->filled(UserProject::USER_ID)) {
            $userProjects->where(UserProject::USER_ID, "=", $request->user_id);
        }
        if ($request->filled(UserProject::PROJECT_ID)) {
            $userProjects->where(UserProject::PROJECT_ID, "=", $request->project_id);
        }
        if ($request->filled(UserProject::IS_DEFAULT)) {
            $userProjects->where(UserProject::IS_DEFAULT, "=", $request->is_default);
        }

        $result = UserProjectResource::collection($userProjects->orderBy(UserProject::IS_DEFAULT, "desc")->get());

        return $this->sendResponse($result, "Show UserProject list");
    }

    /**
     * @OA\Get(
     * path="/api/v1/userProject/user",
     * operationId="userProjectsByUser",
     * tags={"UserProject"},
     * summary="Show UserProjects by logged user",
     * description="Show projects for logged in user",
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
    public function showByLoggedUser(Request $request): JsonResponse
    {
        $userProjects = UserProject::select();
        $userProjects->where(UserProject::USER_ID, "=", $request->user()->id);
        $result = UserProjectResource::collection($userProjects->get());

        return $this->sendResponse($result, "Show projects for logged user");
    }

    /**
     * @OA\Get(
     * path="/api/v1/userProject/project/{projectId}",
     * operationId="projectUsers",
     * tags={"UserProject"},
     * summary="Collection of UserProject by project",
     * description="Show users for selected project by projectId",
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
     * @OA\Delete(
     * path="/api/v1/userProject/{userProjectId}",
     * operationId="deleteUserProject",
     * tags={"UserProject"},
     * summary="Delete UserProject by userProjectId",
     * description="Delete UserProject by userProjectId",
     *     @OA\Parameter(
     *         name="userProjectId",
     *         in="path",
     *         description="UserProject ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $userProjectId
     * @return JsonResponse
     */
    public function delete(int $userProjectId): JsonResponse
    {
        $validator = Validator::make([$userProjectId], [
            $userProjectId => 'required|exists:App\Models\UserProject,id',
        ]);
        if($validator->fails()){
            return $this->sendError('Value is not valid.', 422);
        }
        $userProject = UserProject::findOrFail($userProjectId);
        $userProject->delete();

        return $this->sendResponse($userProject, "UserProject successfully deleted.");
    }
}
