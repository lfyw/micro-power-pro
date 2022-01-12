<?php
namespace App\Supports\Helpers\ApiResponse;

use Illuminate\Support\Facades\Facade;

class XResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'xresponse';
    }
}
