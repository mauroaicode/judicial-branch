<?php

namespace Core\Shared\Infrastructure\Controllers\Utils;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class HandleResponseHttpUtil extends Response
{
    /**
     *  Function base for response.
     *
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public static function responseBase(mixed $data, mixed $code): JsonResponse
    {
        return response()->json(
            $data,
            !$code ? parent::HTTP_INTERNAL_SERVER_ERROR : $code
        );
    }

    /**
     *  Function for response success.
     *
     * @param mixed $data
     * @param int $code This default is 200.
     * @return JsonResponse
     */
    public static function sendSuccess(mixed $data, int $code = parent::HTTP_OK): JsonResponse
    {
        return self::responseBase([
            'isSuccessful' => true,
            'message' => 'Ok',
            'data' => $data
        ], $code);
    }

    /**
     *  Function for response error.
     *
     * @param string $message Error message.
     * @param int $code Code response status.
     * @param mixed $errors This default is array.
     * @return JsonResponse
     */
    public static function sendError(string $message, mixed $code = parent::HTTP_NOT_FOUND, mixed $errors = []): JsonResponse
    {
        $errorCode = is_string($code) ? null : $code;

        return self::responseBase([
            'isSuccessful' => false,
            "message" => $message,
            "errors" => $errors
        ], $errorCode);
    }
}
