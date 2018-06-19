<?php

namespace API\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use JWTAuthException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use API\Http\Requests\LoginUserRequest;
use API\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
            $message = trans('jwt.invalid_login');
            throw new \API\Exceptions\APIException($message, 401);
        }

        return response()->json([
            'mensagem' => trans('jwt.login_success'),
            'objetos' => [
                'user' => app('model.user')->userLogged($request->email)->first()
            ],
            'token' => $token
        ]);       
    }
}
