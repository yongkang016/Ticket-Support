<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateProgressRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'exists:ticket_supports,id',
            'status' => 'required|in:2,3',
            'priority' => 'required|in:1,2,3,4',
        ];
    }
}
