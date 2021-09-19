<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use App\Http\Livewire\Modal;

class EditModal extends Modal
{
	public $id_;
	public $name;

	protected $listeners = [
		'openEditModal' => 'show',
		'showToggled' => 'showToggled',
		'editCategoryErrorBag' => 'editCategoryErrorBag'
	];

	public function showToggled($params) {
		if ($params) {
			$this->id_ = $params['id'];
			$category = Category::find($this->id_);
			$this->name = $category->name;
		}
	}

	public function emitEvent() {
		$this->emit('updateCategory', [
			'id' => $this->id_,
			'name' => $this->name
		]);
	}
	
	public function editCategoryErrorBag($errorBag) {
		$this->setErrorBag($errorBag);
	}

    public function render()
    {
        return view('livewire.category.edit-modal');
    }
}
