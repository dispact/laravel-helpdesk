<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\BuildingStaff;
use App\Models\CategoryStaff;

class StaffController extends Controller
{
    public function index() {
        return view('staff.index', [
            'allStaff' => Staff::latest()
            ->with(['buildings', 'categories', 'user'])
            ->paginate(10)
        ]);
    }

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            return response()->json([
                'msg' => 'Invalid email address'
            ], 400);
        }

        try {
            $user = User::firstWhere('email', $request->email);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Email does not belong to a user'], 400);
        }

        if (Staff::where('user_id', $user->id)->first()) {
            return response()->json(['msg' => 'Staff already exists!'], 400);
        }

        try {
            Staff::create([
                'user_id' => $user->id
            ]);

            $user->staff = true;
            $user->save();

            return response()->json(['msg' => 'Staff created'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error creating staff'], 400);
        }
    }

    public function update(Request $request) {
        try {
            try {
                $request->validate([
                    'staff_id' => 'required',
                    'category_id' => 'required',
                    'building_id' => 'required'
                ]);
            } catch (\exception $e) {
                return response()->json(['msg' => 'All fields required!'], 400);
            }
            
            CategoryStaff::where('staff_id', $request->staff_id)->delete();
            BuildingStaff::where('staff_id', $request->staff_id)->delete();

            $staff = Staff::find($request->staff_id);

            $staff->categories()->attach($request->category_id);
            $staff->buildings()->attach($request->building_id);
            
            return response()->json(['msg' => 'Staff details updated!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error updating staff...'], 400);
        }
    }

    public function destroy(Request $request) {
        try {
            $request->validate([
                'staff_id' => 'required'
            ]);

            $staff = Staff::find($request->staff_id);
            $user = User::firstWhere('id', $staff->user_id);
            $user->staff = false;
            $user->save();
            $staff->delete();

            return response()->json(['msg' => 'Staff deleted!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error deleting staff...'], 400);
        }
    }
}
