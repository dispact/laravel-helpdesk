<?php

namespace App\View\Components\Forms;

use App\Models\Building;
use Illuminate\View\Component;

class BuildingSelect extends Component
{
    public $label, $identifier, $name, $val;

    public function __construct($label, $identifier, $name, $val) {
        $this->label = $label;
        $this->identifier = $identifier;
        $this->name = $name ?? $this->identifier;
        $this->val = $val;
    }

    public function render()
    {
        return view('components.forms.building-select', [
            "buildings" => Building::all(),
            "label" => $this->label,
            "id" => $this->identifier,
            "name" => $this->name ?? $this->identifier,
            "val" => $this->val ?? ''
        ]);
    }
}
