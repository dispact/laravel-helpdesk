<?php

namespace App\Http\Livewire\Device;

use App\Models\Device;
use Livewire\Component;
use App\Http\Livewire\Modal;

class EditModal extends Modal
{
    public $ogAsset = '';
    public $assetTag = '';
    public $deviceModel = '';
    public $building = '';
    public $serialNumber = '';
    public $macAddress = '';

	protected $listeners = [
		'openEditModal' => 'show',
		'showToggled' => 'showToggled',
		'editDeviceErrorBag' => 'editDeviceErrorBag'
	];

	public function showToggled($params) {
		if ($params) {
			$this->ogAsset = $params['id'];
			$device = Device::find($this->ogAsset);
			$this->assetTag = $device->asset_tag;
			$this->deviceModel = $device->model_id;
			$this->building = $device->building_id;
            $this->serialNumber = $device->serial_number;
            $this->macAddress = $device->mac_address;
        }
	}

	public function emitEvent() {
		$this->emit('updateDevice', [
			'og_asset' => $this->ogAsset,
			'asset_tag' => $this->assetTag,
            'model' => $this->deviceModel == '0' ? null : $this->deviceModel,
            'building' => $this->building == '0' ? null : $this->building,
            'serial_number' => $this->serialNumber,
            'mac_address'=> $this->macAddress
		]);
	}
	
	public function editDeviceErrorBag($errorBag) {
		$this->setErrorBag($errorBag);
	}

    public function render()
    {
        return view('livewire.device.edit-modal');
    }
}
