<?php

namespace App\Http\Livewire\DeviceModel;

use Livewire\Component;
use App\Models\DeviceModel;
use App\Http\Livewire\Modal;

class EditModal extends Modal
{
    public $id_ = '';
	public $name = '';
    public $manufacturer = '';
    public $type = '';

	protected $listeners = [
		'openEditModal' => 'show',
		'showToggled' => 'showToggled',
		'editDeviceModelErrorBag' => 'editDeviceModelErrorBag'
	];

	public function showToggled($params) {
		if ($params) {
			$this->id_ = $params['id'];
			$model = DeviceModel::find($this->id_);
			$this->name = $model->name;
			$this->manufacturer = $model->manufacturer;
			$this->type = $model->type;
        }
	}

	public function emitEvent() {
		$this->emit('updateDeviceModel', [
			'id' => $this->id_,
			'name' => $this->name,
            'manufacturer' => $this->manufacturer,
            'type' => $this->type
		]);
	}
	
	public function editDeviceModelErrorBag($errorBag) {
		$this->setErrorBag($errorBag);
	}

    public function render()
    {
        return view('livewire.device-model.edit-modal');
    }
}
