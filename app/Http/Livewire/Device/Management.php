<?php

namespace App\Http\Livewire\Device;

use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    use WithPagination;

    public $sortField;
    public $sortAsc;
    public $search;
    public $model;
    public $building;

    protected $queryString = ['search', 'sortField', 'sortAsc', 'model', 'building'];

    protected $listeners = [
        'createDevice' => 'create',
        'updateDevice' => 'update',
        'deleteDevice' => 'delete',
    ];

    public function updatingSearch() {
        $this->resetPage();
    }

    public function sortBy($field) {
        if ($this->sortField == $field)
            $this->sortAsc = !$this->sortAsc;
        else
            $this->sortAsc = true;

        $this->sortField = $field;
    }

    public function create($payload) {
        try {
            // Validate information and make sure name doesn't exist
            $validated = Validator::make($payload, [
                'asset_tag' => 'required|string|unique:devices',
                'model_id' => 'nullable|exists:device_models,id',
                'building_id' => 'nullable|exists:buildings,id',
                'serial_number' => 'nullable|string|unique:devices,serial_number',
                'mac_address' => 'nullable|string|unique:devices,mac_address'
            ], [
                'asset_tag.unique' => 'Asset tag already exists',
                'model.exists' => 'Device model does not exist',
                'building.exists' => 'Building does not exist',
                'serial_number.unique' => 'Serial number belongs to another asset',
                'mac_address.unique' => 'MAC address belongs to another asset'
            ])->validate();

            try {
                // Create the device model
                $device = Device::create(['asset_tag' => $payload['asset_tag']]);
                
                // Assign details that are not nulled
                if($payload['model_id']) $device->model_id = $payload['model_id'];
                if($payload['building_id']) $device->building_id = $payload['building_id'];
                if($payload['serial_number']) $device->serial_number = $payload['serial_number'];
                if($payload['mac_address']) $device->mac_address = $payload['mac_address'];
                $device->save();

                $this->emitTo('device.create-modal', 'show');
                $this->emit('flashSuccess', 'Device created');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to create device');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createDeviceErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Validate information and make sure name doesn't exist
            $validated = Validator::make($payload, [
                'og_asset' => 'required|string|exists:devices,asset_tag',
                'asset_tag' => [
                    'required',
                    'string',
                    Rule::unique('devices')->ignore($payload['og_asset'], 'asset_tag')
                ],
                'model' => 'nullable|exists:device_models,id',
                'building' => 'nullable|exists:buildings,id',
                'serial_number' => [
                    'nullable',
                    'string',
                    Rule::unique('devices')->ignore($payload['og_asset'], 'asset_tag')
                ],
                'mac_address' => [
                    'nullable',
                    'string',
                    Rule::unique('devices')->ignore($payload['og_asset'], 'asset_tag')
                ]
            ], [
                'asset_tag.unique' => 'Asset tag already exists',
                'model.exists' => 'Device model does not exist',
                'building.exists' => 'Building does not exist',
                'serial_number.unique' => 'Serial number belongs to another asset',
                'mac_address.unique' => 'MAC address belongs to another asset'
            ])->validate();

            try {
                // Create the device model
                $device = Device::find($payload['og_asset']);
                $device->asset_tag = $payload['asset_tag'];
                $device->model_id = $payload['model'];
                $device->building_id = $payload['building'];
                $device->serial_number = $payload['serial_number'];
                $device->mac_address = $payload['mac_address'];
                $device->save();

                $this->emitTo('device.edit-modal', 'show');
                $this->emit('flashSuccess', 'Device updated');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update device');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editDeviceErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:devices,asset_tag']
            )->validate();

            try {
                Device::find($id)->delete();
                $this->emit('flashSuccess', 'Device delete');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete device');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
        }
    }

    public function render()
    {
        return view('livewire.device.management', [
            'devices' => Device::filter([
                'search' => $this->search, 
                'sortField' => $this->sortField,
                'sortAsc' => $this->sortAsc,
                'model' => $this->model,
                'building' => $this->building
            ])
                ->with(['building', 'model'])
                ->paginate(10)
                ->withQueryString()
        ]);
    }
}