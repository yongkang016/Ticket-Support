<?php

namespace App\Http\Controllers;

use App\Constants\WebRouteName;
use App\Http\Requests\Ticket\StoreMessageRequest;
use App\Http\Requests\Ticket\TicketRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Http\Requests\Ticket\TicketUpdateProgressRequest;
use App\Models\TicketSupport;
use App\Models\User;

use App\Services\ChatService;
use App\Services\ProjectService;
use App\Services\TicketService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class TicketController extends Controller
{
    public function ticketIndex(Request $ticketRequest)
    {
        $filters = $ticketRequest->only('title', 'status', 'priority', 'project_name');

        $userData = User::all(); // Retrieve all users for display if needed

        $query = TicketSupport::with('createdByUser', 'projectName', 'staffProject');

        $user = auth()->user(); // Get the authenticated user

        $role = $user->role; // Get the role (ensure `role` is accessible here)

        // Apply filters based on role
        if ($role == 3) { // Assuming `3` is the ID for client
            $query->where('created_by', $user->id); // Restrict tickets to user's own submissions
        }

        // Apply additional filters and fetch data
        $data = $query->filter($filters)->get();

        return view('/pages/ticket.ticketDashboard', [
            'data' => $data,
            'users' => $userData,
        ]);
    }

    public function create()
    {
        return view('/pages/ticket.ticketCreate', [
            'method' => 'POST',
            'model_ticket' => new TicketSupport(),
            'action' => route(WebRouteName::WEB_ROUTE_TICKET_STORE),
        ]);
    }

    public function store(TicketRequest $request)
    {
        $data = $request->validated();
        //        validated from class CompanyRequest extends **FormRequest**
        $data['status'] = '1'; //Status = Opened
        $data['created_by'] = auth()->id();
        $data['priority'] = '0'; // Priority = Pending

        /** @var TicketService $ticketService */
        $ticketService = app(TicketService::class);

        $ticketService->create($data);

        return redirect()->route(WebRouteName::WEB_ROUTE_TICKET_INDEX)
            ->with('success', 'Ticket created successfully.');

    }

    public function update(TicketUpdateRequest $request)
    {
        $data = $request->validated();

        $data['status'] = '2'; //Status = In Progress

        /** @var TicketService $ticketService */
        $ticketService = app(TicketService::class);

        $ticket_id = \App\Models\TicketSupport::findOrFail($data['id']);

        // Call a service to handle the update logic
        $result = $ticketService->update($ticket_id,$data);

        if ($result) {
            return redirect()->route(WebRouteName::WEB_ROUTE_TICKET_INDEX)->with('success', 'Ticket updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update ticket.');
        }
    }


    public function updateProgress(TicketUpdateProgressRequest $request)
    {
        $data = $request->validated();



        /** @var TicketService $ticketService */
        $ticketService = app(TicketService::class);

        $ticket_id = \App\Models\TicketSupport::findOrFail($data['id']);

        // Call a service to handle the update logic
        $result = $ticketService->update($ticket_id,$data);

        if ($result) {
            return redirect()->route(WebRouteName::WEB_ROUTE_TICKET_INDEX)->with('success', 'Ticket updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update ticket.');
        }
    }






}
