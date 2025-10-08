<?php

namespace App\helpers;

class ApiResponse
{

    public static function response($data = null, $status = 200, $message = null)
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'message' => $message,
        ], $status);
    }
}
