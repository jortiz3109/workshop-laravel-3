<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ImportException extends Exception
{
    private $errors;

    public function __construct(
        array $errors,
        $message = "An error occurred when trying to import your records",
        $code = 0,
        Throwable $previous = null
    ) {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
