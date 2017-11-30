<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 7/8/17
 * Time: 4:08 PM
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('login', 'password');
        $user = false;
        if(Auth::attempt($credentials))
        {
            $user = User::where('login', $credentials['login'])->with('staff.role')->first();
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials, ['user' => $user])) {
                return response()->json([
                    'code' => 401,
                    'message' => 'invalid_credentials'
                ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'code' => 500,
                'message' => 'could_not_create_token'
            ], 500);
        }

        // all good so return the token
        return response()->json([
            'code' => 200,
            'message' => 'OK',
            'result' => compact('token')
        ], 200);
    }
}