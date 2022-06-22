<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserProjectResource;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProjectController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            UserProject::PROJECT_ID => 'required|integer|exists:user_projects,id',
            UserProject::USER_ID => 'required|integer|exists:users,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $userProject = UserProject::create($input);

        $result = [
            "user_project" => $userProject,
        ];

        return $this->sendResponse($result, "UserProject created");
    }

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
