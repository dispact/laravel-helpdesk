<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'ilike', '%' . $search . '%')
                    ->orWhere('content', 'ilike', '%' . $search . '%')
            )  
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn($query) => 
                $query->where('id', $category)
            )
        );

        if (array_key_exists('status', $filters)) {
            if ($filters['status'] === 'all')
                $stat = false;
            else
                $stat = $filters['status'];
        }

        $query->when($stat ?? '1,2', fn($query, $status) =>
            $query->whereHas('status', fn($query) => 
                $query->whereIn('id', explode(',', $status))
            )
        );


        if (array_key_exists('staff', $filters)) {
            if ($filters['staff'] === 'all')
                $s = false;
            else
                $s = $filters['staff']; 
        } else {
            if(request()->route()->named('tickets.index'))
                $s = auth()->user()->id;
            else
                $s = false;
        }
    
        $query->when($s, fn($query, $staff) =>
            $query->whereHas('staff', fn($query) =>
                $query->where('staff_id', $staff)
            )
        );

        // if (array_key_exists('building', $filters)) {
        //     if ($filters['building'] === 'all')
        //         $b = false;
        //     else
        //         $b = $filters['staff']; 
        // } else {
        //     $b = Staff::where('user_id', auth()->user()->id)->first()->building_id;
        // }

        // $query->when($b, fn($query, $building) =>
        //     $query->whereHas('building', fn($query) =>
        //         $query->where('id', $building)
        //     )
        // );
    }

    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function staff() {
        return $this->belongsToMany(Staff::class)->using(StaffTicket::class);
    }
}
