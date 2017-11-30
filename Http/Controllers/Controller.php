<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function json($code = 400, $message = 'Something went wrong', $result = [], $headers = [])
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'result' => $result,
        ], $code, $headers);
    }

    protected function formatValidationErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
