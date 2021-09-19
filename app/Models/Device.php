<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $primaryKey = 'asset_tag';
    protected $keyType = 'string';
    public $incrementing = false;

    use HasFactory;

    protected $guarded = [];

    public function model() {
        return $this->belongsTo(DeviceModel::class);
    }

    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('asset_tag', 'like', '%' . $search . '%')
                    ->orWhere('serial_number', 'like', '%' . $search . '%')
                    ->orWhere('mac_address', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['sortField'] ?? false, fn($query, $sortField) =>
            $query->when($filters['sortAsc'] ?? false, fn($query, $sortAsc) =>
                $query->orderBy($sortField, 'DESC')
            )
        );

        $query->when($filters['model'] ?? false, fn($query, $model) =>
            $query->where('model_id', $model)
        );

        $query->when($filters['building'] ?? false, fn($query, $building) =>
            $query->where('building_id', $building)
        );
    }
}
