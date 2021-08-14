<?php

namespace App\View\Components\Ticket;

use App\Models\Ticket;
use Illuminate\View\Component;

class Author extends Component
{
    public function render()
    {
        return view('components.ticket.author', [
            'recentTickets' => Ticket::where('author_id', request()->ticket->author_id)
                ->where('id', '!=', request()->ticket->id)
                ->paginate(3),
        ]);
    }
}
