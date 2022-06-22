<?php

namespace App\Http\Controllers;

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
     * @return JsonResponse
     */
    public function sendResponse($result, string $message): JsonResponse
    {
        $response = [
            'status' => 0,
            'message' => $message,
        ];

        if ($result !== null) {
            $response += $result;
        }

        return response()->json($response, 200);
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
            'status' => 1,
            'message' => $error,
            'code' => $code
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
            'status' => 2,
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
