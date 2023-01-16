<?php

namespace App\Services;

use Exception;

final class DatafileException extends Exception
{
    public function __construct(string $message, $code = 0, Exception $exception = null)
    {
        parent::__construct($message, $code, $exception);
    }
}
