<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function buildings() {
        return $this->belongsToMany(Building::class)->using(BuildingStaff::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class)->using(CategoryStaff::class);
    }

    public function tickets() {
        return $this->belongsToMany(Ticket::class)->using(StaffTicket::class);
    }
}
