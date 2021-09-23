<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Alert extends Component
{
    public $message;
    public $showAlert = false;
    public $color = 'green';

    protected $listeners = [
        'flashSuccess' => 'flashSuccess',
        'flashError' => 'flashError'
    ];

    public function show() {
        $this->showAlert = !$this->showAlert;
    }

    public function flashSuccess($message) {
        $this->message = $message;
        $this->color = 'green';
        $this->show();
        $this->dispatchBrowserEvent('alert-timeout');
    }
    
    public function flashError($message) {
        $this->message = $message;
        $this->color = 'red';
        $this->show();
        $this->dispatchBrowserEvent('alert-timeout');
    }

    public function render()
    {
        return view('livewire.alert');
    }
}
