<?php

namespace App\View\Components\Filters;

use App\Models\DeviceModel;
use Illuminate\View\Component;

class DeviceModelDropdown extends Component
{
    public function render()
    {
        return view('components.filters.device-model-dropdown', [
            'models' => DeviceModel::all()
        ]);
    }
}
