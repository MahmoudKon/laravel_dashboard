<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BasicApiController extends Controller
{
    public function sendResponse(string $message = '', array $result = []): \Illuminate\Http\JsonResponse
    {
    	$response = ['success' => true];
        if($message !== '') $response['message'] = $message;
        if(! empty($result)) $response = array_merge($response, $result);

        return response()->json($response, 200);
    }

    public function sendError(string $message = '', $errorMessages = [], $code = 404): \Illuminate\Http\JsonResponse
    {
    	$response = ['success' => false];
        if($message !== '') $response['message'] = $message;
        if(!empty($errorMessages)) $response['data'] = $errorMessages;

        return response()->json($response, $code);
    }
}
