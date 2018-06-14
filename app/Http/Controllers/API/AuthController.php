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
        // try {
        if (!$token = JWTAuth::attempt($request->only('cpf', 'password'))) {
            $message = trans('jwt.invalid_login');
            throw new \Sendler\Exceptions\SendlerException($message, 422);
        }

        return response()->json([
            'result' => [
                'token' => $token,
                'user'=>  app('model.user')->userLogged($request->cpf)->first()
            ]
        ]);

        // } catch (JWTAuthException $exception) {
        //     throw new \Exception(trans('token_create_fail'), 422);
        // }        
    }
}
