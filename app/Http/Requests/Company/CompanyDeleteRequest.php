<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyDeleteRequest extends FormRequest
{
    public function rules(){
        return[
            'id' => 'exists:company_industries,id',
        ];
    }
}
