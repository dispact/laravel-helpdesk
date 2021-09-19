<?php

namespace App\View\Components\Filters\Inventory;

use App\Models\Building;
use Illuminate\View\Component;

class BuildingDropdown extends Component
{
    public function render()
    {
        return view('components.filters.inventory.building-dropdown', [
            'buildings' => Building::all()
        ]);
    }
}
