<?php

namespace App\Traits;

trait HttpResponses {

    protected function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'isSuccessful' => true,
            'status' => 'Request was successful.',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($data, string $message = null, int $code)
    {
        return response()->json([
            'isSuccessful' => false,
            'status' => 'An error has occurred...',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
