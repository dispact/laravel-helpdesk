<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    protected $listeners = [
        'createUser' => 'create',
        'updateUser' => 'update',
        'deleteUser' => 'delete',
    ];

    public function create($payload) {
        try {
            // Validate information
            // Validator::make(
            //     ['name' => $name],
            //     ['name' => 'required|string|max:255'],
            //     ['email' => $email],
            //     ['email' => 'required|string|email|max:255|unique:users'],
            //     ['email.unique' => 'Email belongs to a user'],
            //     ['password_confirmation' => $password_confirmation],
            //     ['password' => $password],
            //     ['password' => [
            //         'required',
            //         'confirmed',
            //         Password::defaults()
            //     ]],
            //     ['building' => $building],
            //     ['building' => 'required|exists:buildings']
            // )->validate();
            $validated = Validator::make($payload, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => [
                    'required',
                    'confirmed',
                    Password::defaults()
                ],
                'password_confirmation' => 'required',
                'building' => 'required|exists:buildings,id'
            ])->validate();

            try {
                // Create user
                User::create([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                    'building_id' => $payload['building'],
                    'password' => Hash::make($payload['password'])
                ]);
                $this->dispatchBrowserEvent('successMessage', ['message' => 'User created']);
                $this->emitTo('user.create-modal', 'show');
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error creating user']);
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createUserErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Validate information and that the email doesn't exist
            $validated = Validator::make($payload, [
                'id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $payload['id'],
                'building' => 'required|exists:buildings,id'
            ])->validate();
            
            try {
                // Find user and update their information
                $user = User::find($payload['id']);
                $user->name = $payload['name'];
                $user->email = $payload['email'];
                $user->building_id = $payload['building'];
                $user->save();
                $this->dispatchBrowserEvent('successMessage', ['message' => 'User updated']);
                $this->emitTo('user.edit-modal', 'show');
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error updating user']);
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editUserErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Validate that the ID exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:users']
            )->validate();

            try {
                // Find the user and delete them
                $user = User::find($id);
                $user->delete();
                $this->dispatchBrowserEvent('successMessage', ['message' => 'User deleted']);
            } catch (\exception $e) {
                $this->dispatchBrowserEvent('errorMessage', ['message' => 'Error deleting user']);
            }
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('errorMessage', ['message' => $e->errors()['id'][0]]);
        }
    }

    public function render()
    {
        return view('livewire.user.management', [
            'users' => User::latest()
                ->with(['building'])
                ->paginate(10)
        ]);
    }
}
