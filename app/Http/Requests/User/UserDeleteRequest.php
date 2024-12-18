<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserDeleteRequest extends FormRequest
{
    public function rules(){

        return[
            'id' => 'exists:users,id',
        ];
    }
}
