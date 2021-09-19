<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Http\Livewire\Modal;

class CreateModal extends Modal
{
    public $name = '';

    protected $listeners = [
        'createCategoryErrorBag' => 'createCategoryErrorBag',
        'showToggled' => 'resetValues',
        'openCreateModal' => 'show'
    ];
    
    public function emitEvent() {
        $this->emit('createCategory', [
            'name' => $this->name
        ]);
    }
    
    public function createCategoryErrorBag($errorBag) {
        $this->setErrorBag($errorBag);
    }
    
    public function resetValues() {
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.category.create-modal');
    }
}
