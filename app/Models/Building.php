<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
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

    public function rooms() {
        return $this->hasMany(Room::class);
    }

    public function staff() {
        return $this->belongsToMany(Staff::class)->using(BuildingStaff::class);
    }
}
