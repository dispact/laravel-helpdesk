<?php

namespace App\View\Components\Ticket;

use App\Models\Message;
use Illuminate\View\Component;

class Chat extends Component
{
    public function render()
    {
        return view('components.ticket.chat', [
            'messages' => Message::where('ticket_id', request()->ticket->id)
                ->with('author')
                ->get(),
        ]);
    }
}
