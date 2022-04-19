<?php

namespace App\Http\Controllers;

use App\Models\UserProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProjectController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            UserProject::PROJECT_ID => 'required|integer|exists:user_projects,id',
            UserProject::USER_ID => 'required|integer|exists:users,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $input = $request->all();
        $userProject = UserProject::create($input);

        $result = [
            "user_project" => $userProject,
        ];

        return $this->sendResponse($result, "Project created");
    }

    public function show(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            UserProject::ID => 'nullable|integer|exists:user_projects,id',
            UserProject::PROJECT_ID => 'nullable|integer|exists:projects,id',
            UserProject::USER_ID => 'nullable|integer|exists:users,id',
            UserProject::IS_DEFAULT => 'nullable|boolean',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }


        $userProjects = UserProject::select();

        if ($input[UserProject::ID] !== null) {
            $userProjects->where(UserProject::ID, "=", $input[UserProject::ID]);
        }
        if ($input[UserProject::USER_ID] !== null) {
            $userProjects->where(UserProject::USER_ID, "=", $input[UserProject::USER_ID]);
        }
        if ($input[UserProject::PROJECT_ID] !== null) {
            $userProjects->where(UserProject::PROJECT_ID, "=", $input[UserProject::PROJECT_ID]);
        }
        if ($input[UserProject::IS_DEFAULT] !== null) {
            $userProjects->where(UserProject::IS_DEFAULT, "=", $input[UserProject::IS_DEFAULT]);
        }

        $result = [
            "user_projects" => $userProjects->get(),
        ];

        return $this->sendResponse($result, "Show user projects");
    }
}
