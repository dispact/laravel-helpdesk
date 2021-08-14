<?php

namespace App\View\Components\Ticket;

use App\Models\Staff;
use Illuminate\View\Component;

class EditStaffModal extends Component
{
    public function render()
    {
        return view('components.ticket.edit-staff-modal', [
            'staff' => Staff::all()
        ]);
    }
}
