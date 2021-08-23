<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeviceModel extends Model
{
    use HasFactory;

    public function getModelTypeAttribute($value) {
        return Arr::get(config('enum.model_types'), $value);
    }

    public function getManufacturerAttribute($value) {
        return Arr::get(config('enum.manufacturers'), $value);
    }

    public function devices() {
        return $this->hasMany(Device::class);
    }
}
