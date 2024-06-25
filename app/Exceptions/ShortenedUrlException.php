<?php

namespace App\Exceptions;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as StatusCode;

use Exception;
use Throwable;

class ShortenedUrlException extends Exception
{
    public function __construct($message = '', $code = StatusCode::HTTP_INTERNAL_SERVER_ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function urlNotFound(): self
    {
        return new self('Url not found', StatusCode::HTTP_NOT_FOUND);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
