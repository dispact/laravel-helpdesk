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
}
