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
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Model created']);
                $this->emitTo('device-model.create-modal', 'show');
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error creating model']);
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

                $this->dispatchBrowserEvent('successMessage', ['message' => 'Model updated']);
                $this->emitTo('device-model.edit-modal', 'show');
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error updating model']);
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
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Model deleted']);
            } catch (\exception $e) {
                dd($e);
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error deleting model']);
            }
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['id'][0]]);
        }
    }

    public function render()
    {
        return view('livewire.device-model.management', [
            'models' => DeviceModel::paginate(10)
        ]);
    }
}
