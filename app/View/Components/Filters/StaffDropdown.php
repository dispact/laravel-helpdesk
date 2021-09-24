<?php

namespace App\View\Components\Filters;

use App\Models\Staff;
use Illuminate\View\Component;

class StaffDropdown extends Component
{
    public function render()
    {
        return view('components.filters.staff-dropdown', [
            'staff' => Staff::where('user_id', '!=', auth()->user()->id)->get()
        ]);
    }
}
