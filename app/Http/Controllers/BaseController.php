<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Exceptions\TransactionException;
use Closure;
use Illuminate\Database\ConnectionInterface;
use Throwable;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class BaseController extends Controller
{
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message)
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $code = 404)
    {
        $response = [
            'status' => 1,
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
    public function handleTransaction(Closure $callback)
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
