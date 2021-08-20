<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BuildingStaff extends Pivot
{
    public function staff() {
        return $this->belongsTo(Staff::class);
    }

    public function building() {
        return $this->belongsTo(Building::class);
    }
}