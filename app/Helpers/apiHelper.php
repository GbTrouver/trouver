<?php

function successResponse($data, $message)
{
    $response = [
        'status' => true,
        'message' => $message,
        'data' => $data
    ];

    return response()->json($response, 200);
}

function errorResponse($error, $errorMessages = [], $code = 405)
{
    $response = [
        'status' => false,
        'message' => $error,
    ];

    if (!empty($errorMessages)) {
        $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
}
