<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Building;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BuildingManagement extends Component
{
    use WithPagination;

    public $search;
    protected $queryString = ['search'];

    protected $listeners = [
        'createBuilding' => 'create',
        'updateBuilding' => 'update',
        'deleteBuilding' => 'delete',
    ];

    public function updatingSearch() {
        $this->resetPage();
    }

    public function create($name) {
        // Make sure building name doesn't exist
        try {
            Validator::make(
                ['name' => $name],
                ['name' => 'required|unique:buildings,name']
            )->validate();

            // Create the building
            try {
                Building::create([
                    'name' => $name
                ]);
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Building created']);
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error creating building']);
            }
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['name'][0]]);
        }
    }

    public function update($id, $name) {
        try {
            // Check if building name was entered and doesn't already exists
            Validator::make(
                ['name' => $name],
                ['name' => 'required|unique:buildings,name,' . $id]
            )->validate();

            // Update the building name
            try{
                $building = Building::find($id);
                $building->name = $name;
                $building->save();
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Building updated']);
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error updating building']);
            }

        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['name'][0]]);
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
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Building deleted']);
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error deleting building']);
            }
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['id'][0]]);
        }
    }

    public function paginationView() {
        return 'vendor/livewire/tailwind';
    }

    public function render() {
        return view('livewire.building-management', [
            'buildings' => Building::latest('updated_at')
                ->filter(['search'])
                ->paginate(10)
        ]);
    }
}
