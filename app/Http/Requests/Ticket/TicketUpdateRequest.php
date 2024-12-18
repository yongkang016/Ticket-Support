<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
{
    public function rules()
    {

        return [
            'id' => 'exists:ticket_supports,id',
            'priority' => 'required|in:1,2,3,4',
        ];
    }
}
