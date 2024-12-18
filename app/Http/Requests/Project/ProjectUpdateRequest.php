<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:company_projects,id',
            'name' => 'required|string|max:255',
            'companySelection' => 'required|exists:company_industries,id',
        ];
    }
}
