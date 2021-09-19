<?php

namespace App\Http\Livewire\Status;

use Livewire\Component;
use App\Http\Livewire\Modal;

class CreateModal extends Modal
{

    public $name = '';
    public $color = ''; 

    protected $listeners = [
        'createStatusErrorBag' => 'createStatusErrorBag',
        'showToggled' => 'resetValues',
        'openCreateModal' => 'show'
    ];
    
    public function emitEvent() {
        $this->emit('createStatus', [
            'name' => $this->name,
            'color' => $this->color
        ]);
    }
    
    public function createStatusErrorBag($errorBag) {
        $this->setErrorBag($errorBag);
    }
    
    public function resetValues() {
        $this->name = '';
        $this->color = '';
    }

    public function render()
    {
        return view('livewire.status.create-modal');
    }
}
