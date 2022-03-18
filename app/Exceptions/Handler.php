<?php

namespace App\Exceptions;

use App\Http\Controllers\BaseController;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

//    public function render($request, Throwable $e)
//    {
//        if ($e instanceof ModelNotFoundException) {
//            return $this->responseError("Data not found", 404);
//        }
//
//        // not work
//        if ($e instanceof AuthenticationException) {
//            return $this->responseError("User not Authorized", 401);
//        }
//
//        // not work
//        if ($e instanceof ValidationException) {
//            return $this->responseError("Data not valid", 422);
//        }
//
//        // not work
//        if ($e instanceof NotFoundHttpException) {
//            return $this->responseError("Route not found", 500);
//        }
//
//        return $this->responseError("Something wrong", 404);
//    }

    private function responseError(string $message, int $code): JsonResponse
    {
        return response()->json([
            'status' => 1,
            'message' => $message,
            'code' => $code
        ]);
    }
}
