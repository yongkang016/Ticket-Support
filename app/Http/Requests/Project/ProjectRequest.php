<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;


class ProjectRequest extends FormRequest
{
    public function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'company_id' => 'required|exists:company_industries,id',
            'role' => 'required'
        ];

    }
}
