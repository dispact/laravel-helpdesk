<?php

namespace App\Http\Livewire\Building;

use Livewire\Component;
use App\Http\Livewire\Modal;

class CreateModal extends Modal
{
    public $name = '';

    protected $listeners = [
        'createBuildingErrorBag' => 'createBuildingErrorBag',
        'showToggled' => 'resetValues',
        'openCreateModal' => 'show'
    ];
    
    public function emitEvent() {
        $this->emit('createBuilding', [
            'name' => $this->name
        ]);
    }
    
    public function createBuildingErrorBag($errorBag) {
        $this->setErrorBag($errorBag);
    }
    
    public function resetValues() {
        $this->name = '';
    }
    
    public function render()
    {
        return view('livewire.building.create-modal');
    }
}
