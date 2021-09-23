<?php

namespace App\Http\Livewire\Building;

use Livewire\Component;
use App\Models\Building;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    use WithPagination;

    protected $listeners = [
        'createBuilding' => 'create',
        'updateBuilding' => 'update',
        'deleteBuilding' => 'delete',
    ];

    public function create($payload) {
        try {
            // Validate the informaiton and make sure the
            // building doesn't already exist
            $validated = Validator::make($payload, [
                'name' => 'required|string|unique:buildings,name'
            ])->validate();

            try {
                // Create the building
                Building::create($validated);
                $this->emit('flashSuccess', 'Building created!');
                $this->emitTo('building.create-modal', 'show');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to create building');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createBuildingErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Check if building name was entered and doesn't already exists
            $validated = Validator::make($payload, [
                'id' => 'required',
                'name' => 'required|string|unique:buildings,name,' . $payload['id'],
            ])->validate();

            try{
                // Find the building and update the name
                $building = Building::find($payload['id']);
                $building->name = $payload['name'];
                $building->save();
                $this->emit('flashSuccess', 'Building updated!');
                $this->emitTo('building.edit-modal', 'show');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update building');
            }

        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editBuildingErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Make sure building id exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:buildings']
            )->validate();

            // Delete the building
            try {
                Building::find($id)->delete();
                $this->emit('flashSuccess', 'Building deleted!');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete building');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
        }
    }

    public function paginationView() {
        return 'vendor/livewire/tailwind';
    }

    public function render() {
        return view('livewire.building.management', [
            'buildings' => Building::latest('updated_at')
                ->paginate(10)
        ]);
    }
}
