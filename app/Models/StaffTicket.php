<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StaffTicket extends Pivot
{

    public function ticket() {
        $this->belongsTo(Ticket::class);
    }

    public function staff() {
        $this->belongsTo(Staff::class);
    }
}