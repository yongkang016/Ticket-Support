<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectDeleteRequest extends FormRequest
{
    public function rules()
    {
        return[
            'id' => 'exists:company_projects,id',
        ];
    }
}
