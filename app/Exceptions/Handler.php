<?php

namespace Sendler\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        dd($exception);
        if (! config('app.debug')) {
            // Verifica a Exception do Form Request para retornar JSOn
            if ($exception instanceof \Illuminate\Validation\ValidationException) { 
                return new JsonResponse([
                    'errors' => $exception->errors()
                ], 422); 
            }

            $this->jwtException($exception);

            // Exception do Sistema Sendler
            if ($exception instanceof \Sendler\Exceptions\SendlerException) { 
                return new JsonResponse([
                    'mensagem' => $exception->getMessage()
                ], $exception->getStatusCode()); 
            }

            return new JsonResponse([
                'mensagem' => 'Erro no Sistema! Procure o Administrador.'
            ], 500);
        }

        return parent::render($request, $exception);
    }

    /**
     * [jwtException description]
     * @return [type] [description]
     */
    private function jwtException($exception)
    {
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return response()->json(['error' => trans('jwt.token_invalid')]);
        }

        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return response()->json(['error' => trans('jwt.token_expired')]);
        }
    }
}
