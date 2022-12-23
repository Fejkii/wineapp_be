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

/**
 * @OA\Info(
 *    title="Application API for project WineApp",
 *    version="0.1.0",
 * )
 *
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
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
            "data" => $result,
        ];

        return response()->json($response, $code);
    }

    /**
     * return error response.
     * code 409 - entity already exist
     *
     * @param string $errorMessage
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $errorMessage, int $code = 404): JsonResponse
    {
        $response = [
            'status' => HttpStatusTitle::ERROR,
            'code' => $code,
            'message' => $errorMessage
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
