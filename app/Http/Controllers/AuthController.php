<?php

namespace Sendler\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use DB;
use Hash;
use Mail;
use Illuminate\Support\Facades\Password;
use Sendler\Http\Requests\LoginUserRequest;

class AuthController extends Controller
{
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }
        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token ]]);
    }
}
