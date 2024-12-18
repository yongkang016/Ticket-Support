<?php

namespace App\Http\Controllers;

use App\Constants\WebRouteName;
use App\Http\Requests\Ticket\StoreMessageRequest;
use App\Services\ChatService;
use App\Models\chat;

class ChatController extends Controller
{

    public function storeMessage(StoreMessageRequest $request)
    {
        $data = $request->validated();


        $data['user_id'] = auth()->id();
        //        dd($data);

        /** @var ChatService $chatService */
        $chatService = app(ChatService::class);

        $chatService->create($data);

        return redirect()->route(WebRouteName::WEB_ROUTE_TICKET_INDEX);
    }

    public function getMessages($ticketId)
    {


        // Fetch messages for the given ticketId
        $messages = Chat::where('ticket_id', $ticketId)->orderBy('created_at')->get();

        // You can return the messages as JSON for AJAX requests
        return response()->json($messages);
    }
}
