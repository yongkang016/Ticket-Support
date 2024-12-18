<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function rules()
    {
//        dd($this->request->all());
        return [
            'ticket_id' => 'exists:ticket_supports,id',
            'description' => 'required',
        ];
    }
}
