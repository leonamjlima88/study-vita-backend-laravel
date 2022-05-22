<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $exceptionName = (new \ReflectionClass($exception))->getShortName();

        // Rota não encontrada
        if ($exceptionName === 'NotFoundHttpException') {
            return $this->responseError(
                trans('message_lang.not_found_route_http'),
                Response::HTTP_NOT_FOUND,
                $exceptionName,
            );
        }

        // Rota não encontrada
        if ($exceptionName === 'RouteNotFoundException') {
            return $this->responseError(
                trans('message_lang.route_not_found_or_token_invalid'),
                Response::HTTP_NOT_FOUND,
                $exceptionName,
            );
        }

        // Validação dos dados
        if ($exceptionName === 'ValidationException') {
            return $this->responseError(
                $exception->errors(),
                $exception->status,
                $exceptionName,
            );
        }

        // Validação dos dados (Customizada)
        if ($exceptionName === 'CustomValidationException') {
            return $this->responseError(
                $exception->errors(),
                $exception->status(),
                $exceptionName,
            );
        }      
        
        // Model não encontrado
        if ($exceptionName === 'ModelNotFoundException') {
            return $this->responseError(
                $exception->getMessage(),
                Response::HTTP_BAD_REQUEST,
                $exceptionName,
            );
        }

        // Erro de query
        if ($exceptionName === 'QueryException') {
            return $this->responseError(
                $exception->getMessage(),
                Response::HTTP_BAD_REQUEST,
                $exceptionName,
            );
        }

        // Caso nenhuma exceção seja executada acima.
        return $this->responseError(
            $exception->getMessage(),
            Response::HTTP_BAD_REQUEST,
            "Unexpected exception [${exceptionName}]",
        );
    }
    
    function responseError(mixed $result = [], int $code = Response::HTTP_BAD_REQUEST, string $msg = ''): JsonResponse
    {
        // Quando nenhuma mensagem informado, seta um default
        if (!$msg) {
            $msg = match ($code) {
                Response::HTTP_BAD_REQUEST => trans('message_lang.http_bad_request'),
                Response::HTTP_NOT_FOUND => trans('message_lang.http_not_found'),
                default => '',
            };
        }
    
        // Retornar Resposta
        return response()->json([
            'code' => $code,
            'error' => true,
            'message' => $msg,
            'result' => $result,
        ], $code);        
    }    
}
