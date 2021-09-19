<?php

namespace App\Http\Livewire\Building;

use Livewire\Component;
use App\Models\Building;
use App\Http\Livewire\Modal;

class EditModal extends Modal
{
	public $id_;
	public $name;

	protected $listeners = [
		'openEditModal' => 'show',
		'showToggled' => 'showToggled',
		'editBuildingErrorBag' => 'editBuildingErrorBag'
	];

	public function showToggled($params) {
		if ($params) {
			$this->id_ = $params['id'];
			$building = Building::find($this->id_);
			$this->name = $building->name;
		}
	}

	public function emitEvent() {
		$this->emit('updateBuilding', [
			'id' => $this->id_,
			'name' => $this->name
		]);
	}
	
	public function editBuildingErrorBag($errorBag) {
		$this->setErrorBag($errorBag);
	}

    public function render()
    {
        return view('livewire.building.edit-modal');
    }
}
