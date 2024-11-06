<?php

namespace App\Support\Bases;

use App\Support\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Exception;

abstract class BaseException extends Exception
{
    use ResponseTrait;

    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    abstract public function report(): void;
    abstract public function render($request): JsonResponse;
}
