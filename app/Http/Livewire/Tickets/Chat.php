<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public $ticketId;
    public $message;
    public $messages;

    public function mount($ticketId) {
        $this->ticketId = $ticketId;
        $this->messages = Message::where('ticket_id', $this->ticketId)->get()->toArray();
    }
    

    public function sendMessage() {
        try {
            $message = Message::create([
                'ticket_id' => $this->ticketId,
                'author_id' => auth()->user()->id,
                'content' => $this->message
            ])->toArray();
            array_push($this->messages, $message);
            $this->emit('flashSuccess', 'Message sent!');
        } catch (\exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.tickets.chat', [
            'messages' => $this->messages
        ]);
    }
}
