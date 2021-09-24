<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public $ticketId;
    public $message;
    public $allMessages;

    protected $rules = [
        'message' => 'required'
    ];

    protected $messages = [
        'message.required' => 'The message cannot be blank'
    ];

    public function mount($ticketId) {
        $this->ticketId = $ticketId;
        $this->allMessages = Message::where('ticket_id', $this->ticketId)->get()->toArray();
    }
    
    public function sendMessage() {
        try {
            $this->validate();

            try {
                $message = Message::create([
                    'ticket_id' => $this->ticketId,
                    'author_id' => auth()->user()->id,
                    'content' => $this->message
                ])->toArray();
                array_push($this->allMessages, $message);
                $this->emit('flashSuccess', 'Message sent!');
                $this->message = '';
            } catch (\exception $e) {
                dd($e);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->addError('message', 'hey');
            $this->emit('flashError', $e->errors()['message'][0]);
        }
    }

    public function render()
    {
        return view('livewire.tickets.chat', [
            'messages' => $this->messages
        ]);
    }
}
