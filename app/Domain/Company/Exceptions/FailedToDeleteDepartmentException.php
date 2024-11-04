<?php

namespace App\Domain\Company\Exceptions;

use App\Support\Bases\BaseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FailedToDeleteDepartmentException extends BaseException
{
    public function __construct($message = "Failed to delete the department", $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function report(): void
    {
        Log::error($this->getMessage());
    }

    public function render($request): JsonResponse
    {
        return $this->failedResponse($this->getMessage());
    }
}
