<?php declare(strict_types = 1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class TransactionException extends Exception
{
    /**
     * Throws in case error in chat service.
     *
     * @param string $message Error message
     * @param Throwable $previous Previous error
     */
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST, $previous);
    }
}
