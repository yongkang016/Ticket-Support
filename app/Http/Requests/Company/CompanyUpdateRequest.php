<?php

namespace App\Http\Requests\Company;

use App\Models\company_industry;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{

    public function rules()
    {

        return [
            'id' => 'exists:company_industries,id',
            'name' => 'required',
        ];
    }

}
