<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'message' => $message,
        ];
        if ($result) {
            $response['data'] = $result;
        }
        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }
      
        return response()->json($response, $code);
    }
    public function sendValidationError($field, $error, $errorMessages = [], $code = 422)
    {
        $response = [
            'error' => [$field => $error],
            'message' => 'The given data was invalid.',
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}