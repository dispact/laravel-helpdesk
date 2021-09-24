<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use Livewire\Component;

class Author extends Component
{
    public $recentTickets;
    public $author;

    public function mount() {
        $this->author = request()->ticket->author;
        $this->recentTickets = Ticket::where('author_id', $this->author->id)
                ->where('id', '!=', request()->ticket->id)
                ->limit(3)
                ->get()
                ->toArray();
    }

    public function render()
    {
        return view('livewire.tickets.author');
    }
}
