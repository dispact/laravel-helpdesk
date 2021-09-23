<?php

namespace App\View\Components\Filters;

use App\Models\Status;
use Illuminate\View\Component;

class StatusDropdown extends Component
{
    public function render()
    {
        return view('components.filters.status-dropdown', [
            'statuses' => Status::all()
        ]);
    }
}
