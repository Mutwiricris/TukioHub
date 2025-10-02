<?php

namespace App\Http\Controllers;

use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the user's tickets.
     */
    public function index()
    {
        $tickets = Auth::user()->userTickets()
            ->with(['event', 'ticket.ticketType'])
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Display the specified ticket.
     */
    public function show(UserTicket $ticket)
    {
        // Ensure the authenticated user owns this ticket
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $ticket->load(['event.venue', 'ticket.ticketType', 'order']);
        
        return view('tickets.show', compact('ticket'));
    }
}
