<?php

namespace App\Http\Livewire\DeviceModel;

use Livewire\Component;
use App\Models\DeviceModel;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    use WithPagination;

    protected $listeners = [
        'createDeviceModel' => 'create',
        'updateDeviceModel' => 'update',
        'deleteDeviceModel' => 'delete',
    ];

    public function create($payload) {
        try {
            // Validate information and make sure name doesn't exist
            $validated = Validator::make($payload, [
                'name' => 'required|unique:device_models',
                'manufacturer' => 'required|int',
                'type' => 'required|int'
            ])->validate();

            try {
                // Create the device model
                DeviceModel::create($validated);
                $this->emitTo('device-model.create-modal', 'show');
                $this->emit('flashSuccess', 'Model created');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to create model');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createDeviceModelErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Validate information and make sure name doesn't exist
            $validated = Validator::make($payload, [
                'id' => 'required',
                'name' => 'required|unique:device_models,name,' . $payload['id'],
                'manufacturer' => 'required|int',
                'type' => 'required|int'
            ])->validate();

            try {
                // Get the device model and update it
                $model = DeviceModel::find($payload['id']);
                $model->name = $payload['name'];
                $model->type = $payload['type'];
                $model->manufacturer = $payload['manufacturer'];
                $model->save();

                $this->emitTo('device-model.edit-modal', 'show');
                $this->emit('flashSuccess', 'Model updated');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update model');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editDeviceModelErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:device_models']
            )->validate();

            try {
                DeviceModel::find($id)->delete();
                $this->emit('flashSuccess', 'Model deleted');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete model');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
        }
    }

    public function render()
    {
        return view('livewire.device-model.management', [
            'models' => DeviceModel::paginate(10)
        ]);
    }
}
