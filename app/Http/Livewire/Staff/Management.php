<?php

namespace App\Http\Livewire\Staff;

use App\Models\User;
use App\Models\Staff;
use Livewire\Component;
use App\Models\BuildingStaff;
use App\Models\CategoryStaff;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    protected $listeners = [
        'createStaff' => 'create',
        'updateStaff' => 'update',
        'deleteStaff' => 'delete',
    ];

    public function create($payload) {
        try {
            // Validate the information and that the email
            // belongs to a user
            $validated = Validator::make($payload, [
                'email' => 'required|string|email|max:255|exists:users,email',
                'category' => 'nullable|array',
                'building' => 'nullable|array'
            ], [
                'email.exists' => 'Email does not belong to a user',
            ])->validate();

            try {
                // Check if the user is already a staff
                // If not, then make them a staff
                $user = User::where('email', $payload['email'])->first();
                if (Staff::where('user_id', $user->id)->first())
                    return $this->dispatchBrowserEvent('errorMessage', ['message' => 'Staff already exists!']);;
                $staff = Staff::create([ 'user_id' => $user->id ]);
                $user->staff = true;
                $user->save();
                
                // Assign categories and buildings if selected
                if($payload['category']) $staff->categories()->attach($payload['category']);
                if($payload['building']) $staff->buildings()->attach($payload['building']);

                $this->emitTo('staff.create-modal', 'show');
                $this->emit('flashSuccess', 'Staff created');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to create staff');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createStaffErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Validate the information
            $validated = Validator::make($payload, [
                'id' => 'required|exists:staff',
                'category' => 'nullable|array',
                'building' => 'nullable|array'
            ])->validate();

            try {
                // Check if the staff doesn't exist
                if (!$staff = Staff::find($payload['id'])) {
                    return $this->dispatchBrowserEvent('errorMessage', ['message' => 'Staff does not exist']);
                }
                
                // Remove all categories and buildings from staff
                CategoryStaff::where('staff_id', $staff->id)->delete();
                BuildingStaff::where('staff_id', $staff->id)->delete();

                // Attach the updated categories and buildings
                $staff->categories()->attach($payload['category']);
                $staff->buildings()->attach($payload['building']);

                $this->emitTo('staff.edit-modal', 'show');
                $this->emit('flashSuccess', 'Staff updated');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update staff');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editStaffErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Validate information and that the staff ID exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:staff']
            )->validate();

            try {
                // Find the staff and user model
                // Delete the staff and set Staff bool to false on user
                $staff = Staff::find($id);
                $user = User::find($staff->user_id);
                $staff->delete();
                $user->staff = false;
                $user->save();
                $this->emit('flashSuccess', 'Staff deleted');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete staff');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
        }
    }

    public function render()
    {
        return view('livewire.staff.management', [
            'allStaff' => Staff::latest()
                ->with(['buildings', 'categories', 'user'])
                ->paginate(10)
        ]);
    }
}
