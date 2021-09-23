<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $search;
    public $category;
    public $status;
    public $staff;
    public $building;

    protected $queryString = ['search', 'category', 'status', 'staff', 'building'];

    public function updating() {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tickets.dashboard', [
            'tickets' => Ticket::latest('updated_at')
                ->filter([
                    'search' => $this->search,
                    'category' => $this->category,
                    'status' => $this->status,
                    'staff' => $this->staff,
                    'building' => $this->building
                ])
                ->with('category', 'building', 'status', 'author', 'staff')
                ->paginate(10)
                ->withQueryString()
        ]);
    }
}