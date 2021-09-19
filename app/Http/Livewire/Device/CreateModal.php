<?php

namespace App\Http\Livewire\Device;

use Livewire\Component;
use App\Http\Livewire\Modal;

class CreateModal extends Modal
{
    public $assetTag = '';
    public $deviceModel = '';
    public $building = '';
    public $serialNumber = '';
    public $macAddress = '';

    protected $listeners = [
        'createDeviceErrorBag' => 'createDeviceErrorBag',
        'showToggled' => 'resetValues',
        'openCreateModal' => 'show'
    ];
    
    public function emitEvent() {
        $this->emit('createDevice', [
            'asset_tag' => $this->assetTag,
            'model_id' => $this->deviceModel,
            'building_id' => $this->building,
            'serial_number' => $this->serialNumber,
            'mac_address'=> $this->macAddress
        ]);
    }
    
    public function createDeviceErrorBag($errorBag) {
        $this->setErrorBag($errorBag);
    }
    
    public function resetValues() {
        $this->assetTag = '';
        $this->deviceModel = '';
        $this->building = '';
        $this->serialNumber = '';
        $this->macAddress = '';
    }

    public function render()
    {
        return view('livewire.device.create-modal');
    }
}
