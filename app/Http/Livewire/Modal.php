<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $show = false;

    protected function getListeners() {
        return $this->listeners + ['show'];
    }

    public function show($params=null)
    {
        $this->show = !$this->show;
        $this->emitSelf('showToggled', $params);
    }
}
