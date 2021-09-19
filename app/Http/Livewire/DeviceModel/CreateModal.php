<?php

namespace App\Http\Livewire\DeviceModel;

use Livewire\Component;
use App\Http\Livewire\Modal;

class CreateModal extends Modal
{
    public $name = '';
    public $manufacturer = '';
    public $type = '';

    protected $listeners = [
        'createDeviceModelErrorBag' => 'createDeviceModelErrorBag',
        'showToggled' => 'resetValues',
        'openCreateModal' => 'show'
    ];
    
    public function emitEvent() {
        $this->emit('createDeviceModel', [
            'name' => $this->name,
            'manufacturer' => $this->manufacturer,
            'type' => $this->type
        ]);
    }
    
    public function createDeviceModelErrorBag($errorBag) {
        $this->setErrorBag($errorBag);
    }
    
    public function resetValues() {
        $this->email = '';
        $this->manufacturer = '';
        $this->type = '';
    }

    public function render()
    {
        return view('livewire.device-model.create-modal');
    }
}
