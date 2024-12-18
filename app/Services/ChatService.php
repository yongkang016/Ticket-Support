<?php

namespace App\Services;

use App\Models\chat;

class ChatService
{
    public function create(array $data): chat
    {
//        dd($data);
        return chat::create($data);
    }

    public function update(chat $ticket, array $data): bool
    {
        return $ticket->update($data);
    }

    public function delete(chat $ticket): bool
    {
        return $ticket->delete();
    }
}
