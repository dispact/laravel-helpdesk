<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('name', 'ilike', '%' . $search . '%')
            )  
        );
    }

    public function staff() {
        return $this->belongsToMany(Staff::class)->using(CategoryStaff::class);
    }
}
