<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class AuthenticationController extends Controller
{
    private string $deviceName = "No device name";
    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            User::EMAIL => 'required|string|email|max:255|unique:users',
            User::PASSWORD => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return $this->sendError('Email or password is not valid.', 422);
        }

        $input = $request->all();
        $input[User::PASSWORD] = bcrypt($input[User::PASSWORD]);

        $user = User::create($input);

        if ($request->device_name !== null) {
            $this->deviceName = $request->device_name;
        }

        $token = $user->createToken($this->deviceName)->plainTextToken;
        $user->remember_token = $token;
        $user->save();

        $result = [
            User::REMEMBER_TOKEN => $token,
            "user" => $user,
        ];

        return $this->sendResponse($result, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            User::EMAIL => 'required|string|email|max:255',
            User::PASSWORD => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return $this->sendError('Email or password is not valid.', 422);
        }

        if ($request->device_name !== null) {
            $this->deviceName = $request->device_name;
        }

        if(Auth::attempt([User::EMAIL => $request->email, User::PASSWORD => $request->password])){
            $user = Auth::user();
            $token = $user->createToken($this->deviceName)->plainTextToken;
            $user->remember_token = $token;
            $user->save();

            $userProject = UserProject::where(UserProject::USER_ID, "=", $user->id)
                ->where(UserProject::IS_DEFAULT, "=", true)
                ->first();

            $project = null;
            if ($userProject !== null) {
                $project = Project::whereId($userProject->project_id)->first();
            }

            $result = [
                User::REMEMBER_TOKEN => $token,
                "user" => $user,
                "project" => $project,
            ];

            return $this->sendResponse($result, 'User login successfully.');
        }
        else{
            return $this->sendError('Email or password is wrong.');
        }
    }

    /**
     * Logout api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout (Request $request): JsonResponse
    {
        $user = $request->user();
        $user->tokens()->delete();
        $user->remember_token = null;
        $user->save();
        return $this->sendResponse(null, 'User successfully logged out.');
    }
}
