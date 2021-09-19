<?php

namespace App\Http\Livewire\Status;

use App\Models\Status;
use Livewire\Component;
use App\Http\Livewire\Modal;

class EditModal extends Modal
{
	public $id_;
	public $name;
	public $color;

	protected $listeners = [
		'openEditModal' => 'show',
		'showToggled' => 'showToggled',
		'editStatusErrorBag' => 'editStatusErrorBag'
	];

	public function showToggled($params) {
		if ($params) {
			$this->id_ = $params['id'];
			$status = Status::find($this->id_);
			$this->name = $status->name;
			$this->color = $status->color;
		}
	}

	public function emitEvent() {
		$this->emit('updateStatus', [
			'id' => $this->id_,
			'name' => $this->name,
			'color' => $this->color
		]);
	}
	
	public function editStatusErrorBag($errorBag) {
		$this->setErrorBag($errorBag);
	}

	public function render()
	{
		return view('livewire.status.edit-modal');
	}
}
