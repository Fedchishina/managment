<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //ответ API на запрос
    public function returnResponseData($error, $content, $code, $message, $errors=[])
    {
        $data = [
            'error' => $error,
            'content' => $content,
            'code' => $code,
            'message' => $message,
            'errors' => $errors
        ];

        return response()->json($data, $code);
    }
}
