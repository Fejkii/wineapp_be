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
            ]);

            if($validator->fails()){
                return $this->sendError('Inputs are not valid.', 422);
            }

            $input = $request->all();
            $project = Project::create($input);

            UserProject::create([
                UserProject::USER_ID => Auth::user()->id,
                UserProject::PROJECT_ID => $project->id,
            ]);

            return $this->sendResponse($project, "Project created");
        });
    }

    public function show(int $projectId): JsonResponse
    {
        $project = Project::findOrFail($projectId);

        return $this->sendResponse($project, "Show detail");
    }
}
