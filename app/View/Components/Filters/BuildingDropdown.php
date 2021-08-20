<?php

namespace App\View\Components\Filters;

use App\Models\Staff;
use App\Models\Building;
use Illuminate\View\Component;

class BuildingDropdown extends Component
{
    public function render()
    {
        if (!is_null(request('building')))
            $currentBuilding = Building::firstWhere('id', request('building'));
        else
            $currentBuilding = null;

        return view('components.filters.building-dropdown', [
            'buildings' => Building::all(),
            'currentBuilding' => $currentBuilding,
            'currentStaffBuilding' => Staff::firstWhere('user_id', auth()->user()->id)
        ]);
    }
}
