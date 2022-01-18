<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\AuthRequest;
use App\Http\Resources\User\Auth\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Supports\Enums\CacheKey;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    /**
     * login
     * @todo 验证码
     * @todo 登陆次数限制
     * @todo 登录密码加密
     * @param  mixed $authRequest
     * @return void
     */
    public function login(AuthRequest $authRequest)
    {
        $user = User::firstWhere('name', $authRequest->name);

        //登录次数限制
        $pcLoginFailureCountKey = sprintf("%s%s", CacheKey::PC_LOGIN_FAILURE_COUNT->value, $authRequest->name);
        $pcLoginLockKey = sprintf("%s%s", CacheKey::PC_LOGIN_LOCK->value, $authRequest->name);
        if(Cache::get($pcLoginLockKey)){
            return error("此帐号因连续多次输入错误密码已被锁定", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $wrongPasswordNum = Cache::get($pcLoginFailureCountKey, 0);
        if(!Hash::check($authRequest->password, $user->password)){
            $loginFailureLimiter = 5;
            ++$wrongPasswordNum;
            Cache::put($pcLoginFailureCountKey, $wrongPasswordNum, 60);
            if($wrongPasswordNum < $loginFailureLimiter){
                return error(sprintf("你已连续%u次输入错误的密码,超过%u次帐号将被锁定", $wrongPasswordNum, $loginFailureLimiter), Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            Cache::put($pcLoginLockKey, 1, 600);
            return error("此帐号因连续多次输入错误密码已被锁定", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(!$user->status){
            return error('帐号已被冻结,请联系管理员解除限制.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = $user->createSingleToken($authRequest->client);

        return send_data([
            'token' => $token,
            'user' => new UserResource($user->load(['creator:id,name,nickname'])),
        ]);
    }
}
