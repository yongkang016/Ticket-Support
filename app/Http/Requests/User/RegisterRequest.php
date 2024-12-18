<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' =>'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8', // At least 8 characters
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[\W_]/', // At least one special character
            ],
            'repeat_password' => 'required|same:password',
            'role' => 'required|in:2,3,4',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
