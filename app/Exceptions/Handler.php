<?php

namespace API\Exceptions;

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
     * @param  \Exception $exception
     * @return void
     * @throws Exception
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
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        // dd($exception);
        if (! config('app.debug')) {
            // Verifica a Exception do Form Request para retornar JSOn
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return new JsonResponse([
                    'errors' => $exception->errors()
                ], 422);
            }

            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'mensagem' => trans('jwt.token_invalid.') . ' ' . $exception->getMessage()
                ], 401);
            }

            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'mensagem' => trans('jwt.token_expired') . ' ' .$exception->getMessage()
                ], 401);
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
                return response()->json([
                    'mensagem' => trans('jwt.not_authorized') . ' ' . $exception->getMessage()
                ], 401);
            }

            // Exception do Sistema API
            if ($exception instanceof \API\Exceptions\APiException) {
                return new JsonResponse([
                    'mensagem' => $exception->getMessage()
                ], $exception->getStatusCode());
            }

            // Exception do Sistema API
            if ($exception instanceof NotFoundHttpException) {
                return new JsonResponse([
                    'mensagem' => 'Página Não Encontrada!'
                ], 404);
            }

            return new JsonResponse([
                'mensagem' => 'Erro no Sistema! Procure o Administrador.' . " {$exception->getMessage()}"
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
