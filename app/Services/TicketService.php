<?php

namespace App\Services;

use App\Models\TicketSupport;

class TicketService
{
    public function create(array $data): TicketSupport
    {
        return TicketSupport::create($data);
    }

    public function update(TicketSupport $ticket, array $data): bool
    {
        return $ticket->update($data);
    }

    public function delete(TicketSupport $ticket): bool
    {
        return $ticket->delete();
    }
}
