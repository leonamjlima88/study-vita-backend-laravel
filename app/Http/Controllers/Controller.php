<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

// HTTP_OK = (200) Requisição foi bem sucedida com retorno no corpo da mensagem.
// HTTP_CREATED = (201) Requisição foi bem sucedida e um novo recurso foi criado e retornado no corpo da mensagem.
// HTTP_NO_CONTENT = (204) Requisição foi bem sucedida e não tem corpo de mensagem.
// HTTP_BAD_REQUEST = (400) Servidor não pode processar a requisição devido a alguma falha por parte do servidor. Ex: erro de sintaxe.
// HTTP_NOT_FOUND = (404) Servidor não encontrou o recurso solicitado.

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function baseResponse(): array
    {
        return [
            'code' => '',
            'error' => false,
            'message' => '',
            'result' => [],
        ];
    }

    public function responseSuccess(mixed $result = [], int $code = Response::HTTP_OK, string $msg = ''): JsonResponse
    {
        // Quando nenhuma mensagem informado, seta um default
        if (!$msg){
            $msg = match ($code) {
                Response::HTTP_OK => trans('message_lang.http_ok'),
                Response::HTTP_CREATED => trans('message_lang.http_created'),
                Response::HTTP_BAD_REQUEST => trans('message_lang.http_bad_request'),
                Response::HTTP_NOT_FOUND => trans('message_lang.http_not_found'),
                default => '',
            };
        }

        // Configurar Resposta
        $baseResponse = $this->baseResponse();
        $baseResponse['code'] = $code;
        $baseResponse['error'] = false;
        $baseResponse['message'] = $msg;
        $baseResponse['result'] = $result;

        // Retornar Resposta
        return response()->json($baseResponse, $code);        
    }

    public function responseError(mixed $result = [], int $code = Response::HTTP_BAD_REQUEST, string $msg = ''): JsonResponse
    {
        // Quando nenhuma mensagem informado, seta um default
        if (!$msg) {
            $msg = match ($code) {
                Response::HTTP_BAD_REQUEST => trans('message_lang.http_bad_request'),
                Response::HTTP_NOT_FOUND => trans('message_lang.http_not_found'),
                default => '',
            };
        }

        // Configurar resposta
        $baseResponse = $this->baseResponse();
        $baseResponse['code'] = $code;
        $baseResponse['error'] = true;
        $baseResponse['message'] = $msg;
        $baseResponse['result'] = $result;

        // Retornar Resposta
        return response()->json($baseResponse, $code);
    }
}