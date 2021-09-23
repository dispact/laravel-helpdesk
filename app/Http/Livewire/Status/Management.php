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
                $this->emitTo('status.create-modal', 'show');
                $this->emit('flashSuccess', 'Status created');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to create status');
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
          
            try {
                // Find the status and update the name and color
                $status = Status::find($payload['id']);
                $status->name = $payload['name'];
                $status->color = $payload['color'];
                $status->save();
                $this->emitTo('status.edit-modal', 'show');
                $this->emit('flashSuccess', 'Status updated');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update status');
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
                $this->emit('flashSuccess', 'Status deleted');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete status');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
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
