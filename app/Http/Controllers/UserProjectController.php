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
        $wine = UserProject::create($input);

        return $this->sendResponse($wine, "Project created");
    }

    public function showByUserId(int $userId): JsonResponse
    {
        $userProjects = UserProject::whereUserId($userId)->get();

        return $this->sendResponse($userProjects, "Show user projects by userId");
    }

    public function showByProjectId(int $projectId): JsonResponse
    {
        $userProjects = UserProject::whereProjectId($projectId)->get();

        return $this->sendResponse($userProjects, "Show user projects by projectId");
    }
}
