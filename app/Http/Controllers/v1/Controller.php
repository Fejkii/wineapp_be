<?php

namespace App\Http\Controllers\v1;

use App\Enums\HttpStatusTitle;
use App\Exceptions\TransactionException;
use Closure;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Connection interface realization.
     *
     * @var ConnectionInterface
     */
    protected ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * success response method.
     *
     * @param $result
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse($result, string $message, int $code = 200): JsonResponse
    {
        $response = [
            'status' => HttpStatusTitle::OK,
            'code' => $code,
            'message' => $message,
        ];

        if ($result !== null) {
            $response += $result;
        }

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @param string $error
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, int $code = 404): JsonResponse
    {
        $response = [
            'status' => HttpStatusTitle::ERROR,
            'code' => $code,
            'message' => $error
        ];

        return response()->json($response, $code);
    }

    /**
     * return already exists response.
     *
     * @param string $error
     * @return JsonResponse
     */
    public function sendAlreadyExist(string $error): JsonResponse
    {
        $code = 409;

        $response = [
            'status' => HttpStatusTitle::CONFLICT,
            'message' => $error,
            'code' => $code
        ];

        return response()->json($response, $code);
    }

    /**
     * Wrap closure in db transaction.
     *
     * @param Closure $callback Callback which will be wrapped into transaction
     *
     * @return mixed
     *
     * @throws TransactionException
     */
    public function handleTransaction(Closure $callback): mixed
    {
        try {
            $this->connection->beginTransaction();
            return tap($callback(), function () {
                $this->connection->commit();
            });
        } catch (Throwable $exception) {
            $this->connection->rollBack();
            throw new TransactionException($exception->getMessage(), $exception);
        }
    }
}
