<?php

namespace App\View\Components;

use App\Models\Status;
use Illuminate\View\Component;

class StatusDropdown extends Component
{
    public function render()
    {

        if (!is_null(request('status'))) 
            $currentStatus = Status::whereIn('id', explode(',',request('status')))->get();
        else
            $currentStatus = null;
            
        return view('components.status-dropdown', [
            'statuses' => Status::all(),
            'currentStatus' => $currentStatus
        ]);
    }
}
