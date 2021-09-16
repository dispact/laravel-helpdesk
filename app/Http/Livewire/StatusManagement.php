<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class StatusManagement extends Component
{
    use WithPagination;

    protected $listeners = [
        'createStatus' => 'create',
        'updateStatus' => 'update',
        'deleteStatus' => 'delete',
    ];

    public function create() {

    }

    public function update() {

    }

    public function delete() {

    }

    public function render()
    {
        return view('livewire.status-management', [
            'statuses' => Status::orderBy('id', 'ASC')
                ->paginate(10)
        ]);
    }
}
