<?php
namespace App\Supports\Helpers\ApiResponse;

use Illuminate\Support\Facades\Response as FacadesResponse;

/**
 * api响应格式
 */
class ApiResponse
{
    public function error(String $message, int $status = 400, int $code)
    {
        return FacadesResponse::json([
            'msg' => $message,
            'code' => $code ?: $status
        ], $status);
    }

    public function sendMessage(String $message, int $status = 200)
    {
        return FacadesResponse::json(['msg' => $message], $status);
    }

    public function sendData(array $data, int $status = 200)
    {
        return FacadesResponse::json($data, $status);
    }

    public function noContent(int $status = 204)
    {
        return FacadesResponse::noContent($status);
    }
}
