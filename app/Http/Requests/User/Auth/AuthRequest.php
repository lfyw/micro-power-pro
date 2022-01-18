<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return match($this->route()->getActionMethod()){
            'login' => [
                'name' => ['required', 'exists:users'],
                'password' => ['required'],
                'client' => ['required']
            ],
            default => [],
        };
    }

    public function attributes()
    {
        return [
            'name' => '用户名',
            'password' => '密码',
            'client' => '客户端'
        ];
    }
}
