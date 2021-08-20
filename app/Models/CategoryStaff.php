<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryStaff extends Pivot
{
    public function staff() {
        return $this->belongsTo(Staff::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}