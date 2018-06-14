<?php

namespace Sendler\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use JWTAuthException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Sendler\Http\Requests\LoginUserRequest;
use Sendler\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        try {
            if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        
        return response()->json([
            'response' => 'success',
            'result' => [
                'token' => $token,
            ],
        ]);
    }
}
