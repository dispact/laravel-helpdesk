<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index() {
        return view('buildings.index');
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            Building::create([
                'name' => $request->name
            ]);

            return response()->json(['msg' => 'Building created!'], 200);
          
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error creating building...'], 400);
        }
    }

    public function update(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'building_id' => 'required'
            ]);

            $building = Building::find($request->building_id);
            $building->name = $request->name;
            $building->save();

            return response()->json(['msg' => 'Building updated!'], 200);
          
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error updating building...'], 400);
        }
    }

    public function destroy(Request $request) {
        try {
            $request->validate([
                'building_id' => 'required'
            ]);

            $building = Building::find($request->building_id);
            $building->delete();

            return response()->json(['msg' => 'Building deleted!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error deleting building...'], 400);
        }
    }
}
