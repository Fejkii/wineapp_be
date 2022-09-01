<?php

namespace App\Http\Controllers\v1;

use App\Models\Project;
use App\Models\UserProject;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class ProjectController extends Controller
{
    /**
     * @OA\Post (
     * path="/api/v1/project",
     * operationId="createProject",
     * tags={"Project"},
     * summary="Create Project",
     * description="Create new Project. If the project is the first for the user, then this project is set to isDefault true. If the project is not new but is set to isDefault true, then the other project is set to isDefault false.",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"title"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="is_default", type="boolean"),
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
        return $this->handleTransaction(function () use ($request) {
            $input = $request->all();

            $validator = Validator::make($input, [
                Project::TITLE => 'required|string',
                UserProject::IS_DEFAULT => 'boolean',
            ]);

            if($validator->fails()){
                return $this->sendError('Inputs are not valid.', 422);
            }

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

    /**
     * @OA\Put (
     * path="/api/v1/project/{projectId}",
     * operationId="updateProject",
     * tags={"Project"},
     * summary="Update Project",
     * description="Update Project",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"title"},
     *             @OA\Property(property="title", type="string"),
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
    public function update(Request $request, int $projectId): JsonResponse
    {
        return $this->handleTransaction(function () use ($projectId, $request) {
            $input = $request->all();

            $validator = Validator::make($input, [
                Project::TITLE => 'nullable|string',
            ]);

            if($validator->fails()){
                return $this->sendError('Inputs are not valid.', 422);
            }

            $project = Project::find($projectId);

            if ($request->has(Project::TITLE)) {
                $project->title = $input[Project::TITLE];

                $project->save();
            }

            return $this->sendResponse($project, "Project updated");
        });
    }

    /**
     * @OA\Get (
     * path="/api/v1/project/{projectId}",
     * operationId="showProject",
     * tags={"Project"},
     * summary="Show Project",
     * description="Show Project",
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show(int $projectId): JsonResponse
    {
        $project = Project::findOrFail($projectId);

        $result = [
            "project" => $project,
        ];

        return $this->sendResponse($result, "Show detail");
    }
}
