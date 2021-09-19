<?php

namespace App\Http\Livewire;

use App\Models\Room;
use App\Models\Device;
use App\Models\Building;
use App\Models\DeviceModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DevicesTable extends LivewireDatatable
{

    public function builder() {
        return Device::query()  
            ->leftJoin('device_models', 'device_models.id', 'devices.model_id')
            ->leftJoin('buildings', 'buildings.id', 'devices.building_id')
            ->leftJoin('rooms', 'rooms.id', 'devices.room_id');
    }

    public function columns()
    {
        return [

            Column::name('asset_tag')
                ->label('Asset Tag')
                ->defaultSort('asc')
                ->filterable(),

            Column::name('device_models.name')
                ->label('Model')
                ->filterable($this->models),

            Column::name('buildings.name')
                ->label('Building')
                ->filterable($this->buildings),
            
            Column::name('rooms.name')
                ->label('Room')
                ->filterable($this->rooms)
                ->hide(),
            
            Column::name('serial_number')
                ->label('Serial Number')
                ->filterable(),

            Column::name('mac_address')
                ->label('MAC Address')
                ->filterable(),

            DateColumn::name('created_at')
                ->label('Created')
                ->format('m/d/Y')
                ->hide(),

            Column::callback(['asset_tag'], function($asset_tag) {
                return view('livewire.datatables.device-actions', ['id' => $asset_tag]);
            })->unsortable()->excludeFromExport()

        ];
    }

    public function getModelsProperty() {
        return DeviceModel::pluck('name');
    }

    public function getBuildingsProperty() {
        return Building::pluck('name');
    }

    public function getRoomsProperty() {
        return Room::pluck('name');
    }

    
}