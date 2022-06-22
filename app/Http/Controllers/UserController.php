<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Resources\UserProjectResource;
use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class UserController extends Controller
{
    public function showList(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            UserProject::PROJECT_ID => 'required|integer|exists:projects,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Inputs are not valid.', 422);
        }

        $userProjects = UserProject::whereProjectId($input[UserProject::PROJECT_ID])->get();

        $request = [
            "users" => UserProjectResource::collection($userProjects),
        ];

        return $this->sendResponse($request, "Show User list for this project");
    }

    public function addUserToProject(Request $request): JsonResponse
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
            // return $this->sendAlreadyExist( "User already has this project");
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

        $result = [
            "user_project" => UserProjectResource::make($userProject),
        ];

        return $this->sendResponse($result, "User added to this Project and UserProject created");
    }
}
