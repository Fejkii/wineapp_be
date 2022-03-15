<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class AuthenticationController extends BaseController
{
    /**
     * Register api
     *
     * @return JsonResponse
     */
    public function register(Request $request)
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

        $deviceName = "MyApp";
        if ($request->device_name !== null) {
            $deviceName = $request->device_name;
        }

        $token = $user->createToken($deviceName)->plainTextToken;
        $rememberToken[User::REMEMBER_TOKEN] = $token;
        $user->remember_token = $token;
        $user->save();

        return $this->sendResponse($rememberToken, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            User::EMAIL => 'required|string|email|max:255',
            User::PASSWORD => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return $this->sendError('Email or password is not valid.', 422);
        }

        $deviceName = "MyApp";
        if ($request->device_name !== null) {
            $deviceName = $request->device_name;
        }

        if(Auth::attempt([User::EMAIL => $request->email, User::PASSWORD => $request->password])){
            $user = Auth::user();
            $token = $user->createToken($deviceName)->plainTextToken;
            $rememberToken[User::REMEMBER_TOKEN] = $token;
            $user->remember_token = $token;
            $user->save();

            return $this->sendResponse($rememberToken, 'User login successfully.');
        }
        else{
            return $this->sendError('Email or password is wrong.');
        }
    }

    /**
     * Logout api
     *
     * @return JsonResponse
     */
    public function logout (Request $request) {
        $token = $request->user()->remember_token();
        $token->revoke();
        return $this->sendResponse($token, 'User successfully logged out.');
    }

    /**
     * @return JsonResponse
     */
    protected function sendResetLinkResponse(Request $request): JsonResponse
    {
        return $this->sendResponse(null,"Password reset email sent");

    }

    protected function sendResetLinkFailedResponse(Request $request)
    {
        return $this->sendError("Email could not be sent to this email address", 500);
    }

    public function removeToken(Request $request): JsonResponse
    {
        $user = $request->user();
        if ($user->tokens()) {

            $user->tokens()->delete();
            return $this->sendResponse(null, "Tokens are deleted");
        } else {
            return $this->sendError("User has not tokens");
        }

    }
}
