<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use Livewire\Component;

class Detail extends Component
{
    public Ticket $ticket;
    public $status;
    public $category;
    public $building;

    public function mount() {
        $this->status = $this->ticket->status_id;
        $this->category = $this->ticket->category_id;
        $this->building = $this->ticket->building_id;
    }

    public function updatedStatus($newValue) {
        $this->ticket->status_id = $newValue;
        $this->saveTicket('status');
    }

    public function updatedCategory($newValue) {
        $this->ticket->category_id = $newValue;
        $this->saveTicket('category');
    }

    public function updatedBuilding($newValue) {
        $this->ticket->building_id = $newValue;
        $this->saveTicket('building');
    }

    public function saveTicket($property, $newValue=null) {
        if (!$newValue) $newValue = $this->ticket->$property->name;
        try {
            $this->ticket->save();  
            $this->emit('flashSuccess', ucwords($property) . ' updated to: ' . $newValue);
         } catch (\exception $e) {
             $this->emit('flashError', 'Error updating ' . $property . ' to: ' . $newValue);
         }
    }

    public function render()
    {
        return view('livewire.tickets.detail');
    }
}
