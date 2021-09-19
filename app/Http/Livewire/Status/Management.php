<?php

namespace App\Http\Livewire\Status;

use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    use WithPagination;

    protected $listeners = [
        'createStatus' => 'create',
        'updateStatus' => 'update',
        'deleteStatus' => 'delete',
    ];

    public function create($payload) {
        try {
            $validated = Validator::make($payload, [
                'name' => 'required|string|unique:statuses,name',
                'color' => 'required'
            ])->validate();

            try {
                // Create the status
                Status::create($validated);
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Status created']);
                $this->emitTo('status.create-modal', 'show');
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error creating status']);
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createStatusErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Check if name and color were entered
            // Make sure name doesn't already exist
            $validated = Validator::make($payload, [
                'id' => 'required',
                'name' => 'required|unique:statuses,name,' . $payload['id'],
                'color' => 'required'
            ])->validate();

            // Prevent editing of Open, Pending and Closed status
            if (in_array($payload['id'], ['1', '2', '3'])) {
                throw ValidationException::withMessages([
                    'name' => 'This status name can\'t be edited',
                    'color' => 'This status color can\'t be edited'
                ]);
            }
          
            try {
                // Find the status and update the name and color
                $status = Status::find($payload['id']);
                $status->name = $payload['name'];
                $status->color = $payload['color'];
                $status->save();
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Status updated']);
                $this->emitTo('status.edit-modal', 'show');
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error updating status']);
            }

        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editStatusErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Make sure status id exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:statuses']
            )->validate();

            try {
                // Find the status and delete it
                Status::find($id)->delete();
                $this->dispatchBrowserEvent('successMessage', ['message' => 'Status deleted']);
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error deleting status']);
            }
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['id'][0]]);
        }
    }

    public function render()
    {
        return view('livewire.status.management', [
            'statuses' => Status::orderBy('id', 'ASC')
                ->paginate(10)
        ]);
    }
}
