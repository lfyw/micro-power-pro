<?php

use App\Supports\Helpers\ApiResponse\XResponse;

if (!function_exists('error')){
    /**
     * error
     * 错误响应
     * @param  string $message 响应字符串
     * @param  int $status http 状态码,错误响应一般是 4xx 或者 5xx
     * @param  int $code 错误码,一般情况下与 code 保持一致,如特定业务返回特殊错误码时需返回枚举类制定的错误码
     * @param  array $data 特殊情况下需要返回数据时使用
     * @return void
     */
    function error(string $message, int $status = 400, int $code = null, array $data = [])
    {
        return XResponse::error($message, $status, $code ?: $status, $data);
    }
}

if(!function_exists('no_content')){
    /**
     * no_content
     * 空响应
     * @param  int $status http 状态码
     * @return void
     */
    function no_content(int $status = 204)
    {
        return XResponse::noContent($status);
    }
}

if(!function_exists('send_message')){
    /**
     * send_message
     * 字符串响应
     * @param  string $message 响应字符串
     * @param  int $status 响应 http 状态码
     * @return void
     */
    function send_message(string $message, int $status = 200)
    {
        return XResponse::sendMessage($message, $status);
    }
}

if(!function_exists('send_data')){
    /**
     * send_data
     * 数据响应
     * @param  mixed $data 响应数据
     * @param  int $status 响应 http 状态码
     * @return void
     */
    function send_data(mixed $data, int $status = 200)
    {
        return XResponse::sendData($data, $status);
    }
}
