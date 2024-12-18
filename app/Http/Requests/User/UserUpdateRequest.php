<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'exists:users,id',
            'name' => 'required',
            'roleUpdate' => 'required|in:1,2,3,4',
        ];
    }
}
