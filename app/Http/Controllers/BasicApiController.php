<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BasicApiController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse(string $message, array $result = [])
    {
    	$response = [
            'success' => true,
            'message' => $message,
        ];

        if(! empty($result)) {
            $response = array_merge($response, $result);
        }
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
