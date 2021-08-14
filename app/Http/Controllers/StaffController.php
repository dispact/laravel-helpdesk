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
            'staff' => Staff::latest()
            ->paginate(10)
        ]);
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'email' => 'required'
            ]);

            $user = User::firstWhere('email', $request->email);

            Staff::create([
                'user_id' => $user->id
            ]);

            $user->staff = true;
            $user->save();

            return response()->json(['msg' => 'Staff created!'], 200);
        } catch (\exception $e) {
            dd($e);
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
