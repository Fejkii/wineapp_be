<?php declare(strict_types = 1);

namespace App\Http\Controllers\v1;

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
     * @OA\Post(
     * path="/api/v1/register",
     * operationId="register",
     * tags={"Authentication"},
     * summary="User Registration",
     * description="Registration User Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="email", example="petr@test.cz"),
     *             @OA\Property(property="password", type="string", example="password"),
     *             @OA\Property(property="device_name", type="string"),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Registration Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
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
     * @OA\Post(
     * path="/api/v1/login",
     * operationId="login",
     * tags={"Authentication"},
     * summary="User Login",
     * description="Login User Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="email", example="petr@test.cz"),
     *             @OA\Property(property="password", type="string", example="password"),
     *             @OA\Property(property="device_name", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *         response=201,
     *         description="Login Successfully",
     *         @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
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

            $project = Project::whereId($userProject->project_id)->first();

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
     * @OA\Get(
     * path="/api/v1/logout",
     * operationId="logout",
     * tags={"Authentication"},
     * summary="User Logout",
     * description="Logout User Here",
     *      @OA\Response(
     *          response=201,
     *          description="Logout Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Logout Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
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
