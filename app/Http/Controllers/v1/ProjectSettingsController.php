<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\TransactionException;
use App\Http\Controllers\Controller;
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
                ProjectSettings::DEFAULT_FREE_SULFUR => 'nullable|double',
                ProjectSettings::DEFAULT_LIQUID_SULFUR => 'nullable|double',
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
     * @param int $projectId
     * @return JsonResponse
     */
    public function show(int $projectId): JsonResponse
    {
        $project = ProjectSettings::findOrFail($projectId);

        return $this->sendResponse($project, "Show detail of ProjectSettings");
    }
}
