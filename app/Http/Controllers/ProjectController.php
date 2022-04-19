<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserProject;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        return $this->handleTransaction(function () use ($request) {
            $validator = Validator::make($request->all(), [
                Project::TITLE => 'required|string',
                UserProject::IS_DEFAULT => 'boolean',
            ]);

            if($validator->fails()){
                return $this->sendError('Inputs are not valid.', 422);
            }

            $input = $request->all();
            $project = Project::create($input);

            $userId = Auth::user()->id;

            $userProjects = UserProject::whereUserId($userId)->get();

            if ($input[UserProject::IS_DEFAULT] == true) {
                if ($userProjects->isNotEmpty()) {
                    foreach ($userProjects as $userProject) {
                        $userProject->is_default = false;
                        $userProject->save();
                    }
                }
            } else {
                if ($userProjects->isEmpty()) {
                    $input[UserProject::IS_DEFAULT] = true;
                }
            }

            //TODO: on delete, set another default project

            $userProject = UserProject::create([
                UserProject::USER_ID => $userId,
                UserProject::PROJECT_ID => $project->id,
                UserProject::IS_DEFAULT => $input[UserProject::IS_DEFAULT],
            ]);

            $result = [
                "project" => $project,
                "user_project" => $userProject,
            ];

            return $this->sendResponse($result, "Project created");
        });
    }

    public function show(int $projectId): JsonResponse
    {
        $project = Project::findOrFail($projectId);

        $result = [
            "project" => $project,
        ];

        return $this->sendResponse($result, "Show detail");
    }
}
