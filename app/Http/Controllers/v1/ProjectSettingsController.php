<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\TransactionException;
use App\Http\Controllers\v1\Controller;
use App\Http\Resources\ProjectSettingsResource;
use App\Models\ProjectSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectSettingsController extends Controller
{
    /**
     * @OA\Put (
     * path="/api/v1/projectSettings/{projectSettingsId}",
     * operationId="updateProjectSettings",
     * tags={"ProjectSettings"},
     * summary="Update ProjectSettings",
     * description="Update ProjectSettings",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={},
     *             @OA\Property(property="defaultFreeSulfur", type="double"),
     *             @OA\Property(property="defaultLiquidSulfur", type="double"),
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
     * @param int $projectSettingsId
     * @return JsonResponse
     * @throws TransactionException
     */
    public function update(Request $request, int $projectSettingsId): JsonResponse
    {
        return $this->handleTransaction(function () use ($projectSettingsId, $request) {
            $projectSettings = ProjectSettings::findOrFail($projectSettingsId);
            $input = $request->all();

            $validator = Validator::make($input, [
                ProjectSettings::DEFAULT_FREE_SULFUR => 'nullable|numeric',
                ProjectSettings::DEFAULT_LIQUID_SULFUR => 'nullable|numeric',
            ]);

            if($validator->fails()){
                return $this->sendError('Inputs are not valid.', 422);
            }

            $projectSettings->updateOrFail($input);
            $projectSettings->save();

            return $this->sendResponse($projectSettings, "ProjectSettings updated");
        });
    }

    /**
     * @OA\Get (
     * path="/api/v1/projectSettings/{projectSettingsId}",
     * operationId="showProjectSettings",
     * tags={"ProjectSettings"},
     * summary="Show ProjectSettings",
     * description="Show ProjectSettings",
     *     @OA\Parameter(
     *         name="projectSettingsId",
     *         in="path",
     *         description="ProjectSettings ID",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Response Successfull",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     * @param int $projectSettingsId
     * @return JsonResponse
     */
    public function show(int $projectSettingsId): JsonResponse
    {
        $projectSettings = ProjectSettings::findOrFail($projectSettingsId);

        return $this->sendResponse($projectSettings, "Show detail of ProjectSettings");
    }

    /**
     * @OA\Get (
     * path="/api/v1/projectSettings/projekt/{projectId}",
     * operationId="showProjectSettingsByProject",
     * tags={"ProjectSettings"},
     * summary="Show ProjectSettings by ProjectId",
     * description="Show ProjectSettings by ProjectId",
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
        $projectSettings = ProjectSettings::whereProjectId($projectId)->first();
        $result = ProjectSettingsResource::make($projectSettings);

        return $this->sendResponse($result, "Show detail of ProjectSettings");
    }
}
