<?php

namespace App\View\Components\Filters;

use App\Models\Building;
use Illuminate\View\Component;

class BuildingDropdown extends Component
{
    public function render()
    {
        return view('components.filters.building-dropdown', [
            'buildings' => Building::all()
        ]);
    }
}
