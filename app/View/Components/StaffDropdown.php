<?php

namespace App\View\Components;

use App\Models\Staff;
use Illuminate\View\Component;

class StaffDropdown extends Component
{
    public function render()
    {
        if (!is_null(request('staff')))
            $currentStaff = request('staff') != 'all' ? Staff::firstWhere('id', request('staff')) : '';
        else
            $currentStaff = '';

        return view('components.staff-dropdown', [
            'staff' => Staff::with('user')->get(),
            'currentStaff' => $currentStaff
        ]);
    }
}
