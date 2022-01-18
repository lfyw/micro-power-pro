<?php
namespace App\Supports\Helpers\ApiResponse;

use Illuminate\Support\Facades\Response;

class ApiResponse
{
    public function error(string $message, int $status = 400, int $code = 400, array $data = [])
    {
        return Response::json([
            'msg' => $message,
            'code' => $code ?: $status,
            'data' => $data
        ], $status);
    }

    public function sendMessage(string $message, int $status = 200)
    {
        return Response::json(['msg' => $message], $status);
    }

    public function sendData(mixed $data, int $status = 200)
    {
        return Response::json($data, $status);
    }

    public function noContent(int $status = 204)
    {
        return Response::noContent($status);
    }
}
