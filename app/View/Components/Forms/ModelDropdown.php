<?php

namespace App\View\Components\Forms;

use App\Models\DeviceModel;
use Illuminate\View\Component;

class ModelDropdown extends Component
{
    public $label, $identifier, $name;

    public function __construct($label, $identifier, $name) {
        $this->label = $label;
        $this->identifier = $identifier;
        $this->name = $name ?? $this->identifier;
    }

    public function render()
    {
        return view('components.forms.model-dropdown', [
            "items" => DeviceModel::all(),
            "label" => $this->label,
            "id" => $this->identifier,
            "name" => $this->name ?? $this->identifier,
        ]);
    }
}
