<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index() {
        return view('users.index', [
            'users' => User::latest()
                ->with(['building'])
                ->filter(request(['search']))
                ->paginate(10)
        ]);
    }

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'building' => 'required'
        ]);

        if($validator->fails()) {
            $failed = $validator->failed();
        
            if (isset($failed['email']['Unique']))
                $msg = 'Email already exists!';
            else if (isset($failed['password']['Illuminate\Validation\Rules\Password']))
                $msg = 'Password must be 8 characters!';
            else
                $msg = 'All fields required!';

            return response()->json(['errors' => $validator->errors(),
                'msg' => $msg
            ], 400);
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'building_id' => $request->building,
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['msg' => 'User created!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error creating user..'], 400);
        }
    }

    public function update(Request $request) {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user_id,
            'building' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()) {
            $failed = $validator->failed();
        
            if (isset($failed['email']['Unique']))
                return response()->json(['errors' => $validator->errors(),
                    'msg' => 'Email already exists!'
                ], 400);
            else
                return response()->json(['errors' => $validator->errors(),
                    'msg' => 'All fields required!'
                ], 400);
        }

        try {
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->building_id = $request->building;
            $user->save();

            return response()->json(['msg' => 'User updated!'], 200);
        } catch (\exception $e) {
            dd($e);
            return response()->json(['msg' => 'Error updating user...'], 400);
        }
    }
    
    public function destroy(Request $request) {
        $request->validate([
            'user' => 'required'
        ]);

        try {
            $user = User::find($request->user);
            $user->delete();

            return response()->json(['msg' => 'User deleted!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error deleting user...'], 400);
        }
    }
}
