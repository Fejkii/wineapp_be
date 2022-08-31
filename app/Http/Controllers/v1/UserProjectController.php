<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\UserProjectResource;
use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProjectController extends Controller
{
    /**
     * @OA\Post (
     * path="/api/v1/createUserProject",
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

    // TODO Swagger annotation
    public function show(Request $request): JsonResponse
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

        if ($request->has(UserProject::ID) && $request->filled(UserProject::ID)) {
            $userProject->where(UserProject::ID, "=", $input[UserProject::ID]);
        }
        if ($request->has(UserProject::USER_ID) && $request->filled(UserProject::USER_ID)) {
            $userProject->where(UserProject::USER_ID, "=", $input[UserProject::USER_ID]);
        }
        if ($request->has(UserProject::PROJECT_ID) && $request->filled(UserProject::PROJECT_ID)) {
            $userProject->where(UserProject::PROJECT_ID, "=", $input[UserProject::PROJECT_ID]);
        }
        if ($request->has(UserProject::IS_DEFAULT) && $request->filled(UserProject::IS_DEFAULT)) {
            $userProject->where(UserProject::IS_DEFAULT, "=", $input[UserProject::IS_DEFAULT]);
        }

        $userProject = $userProject->first();
        $project = Project::whereId($userProject->project_id)->first();

        $result = [
            "project" => $project,
            "user_project" => $userProject,
        ];

        return $this->sendResponse($result, "Show UserProject and Project");
    }

    // TODO Swagger annotation
    public function showList(Request $request): JsonResponse
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

        if ($request->has(UserProject::ID) && $request->filled(UserProject::ID)) {
            $userProjects->where(UserProject::ID, "=", $input[UserProject::ID]);
        }
        if ($request->has(UserProject::USER_ID) && $request->filled(UserProject::USER_ID)) {
            $userProjects->where(UserProject::USER_ID, "=", $input[UserProject::USER_ID]);
        }
        if ($request->has(UserProject::PROJECT_ID) && $request->filled(UserProject::PROJECT_ID)) {
            $userProjects->where(UserProject::PROJECT_ID, "=", $input[UserProject::PROJECT_ID]);
        }
        if ($request->has(UserProject::IS_DEFAULT) && $request->filled(UserProject::IS_DEFAULT)) {
            $userProjects->where(UserProject::IS_DEFAULT, "=", $input[UserProject::IS_DEFAULT]);
        }

        $result = [
            'user_projects' => UserProjectResource::collection($userProjects->orderBy(UserProject::IS_DEFAULT, "desc")->get()),
        ];

        return $this->sendResponse($result, "Show UserProject list");
    }
}
