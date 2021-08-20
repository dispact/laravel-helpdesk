<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index() {
        return view('status.index', [
            'statuses' => Status::filter(request(['search']))
                ->orderBy('id', 'ASC')
                ->paginate(10)
        ]);
    }

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|unique:statuses,name',
            'color' => 'required'
        ]);

        if($validator->fails()) {
            $failed = $validator->failed();

            if (isset($failed['name']['unique']))
                $msg = 'Status already exists!';
            else 
                $msg = 'All fields required';

            return response()->json(['errors' => $validator->errors(),
                'msg' => $msg
            ], 400);
        }

        try {
            Status::create([
                'name' => $request->name,
                'color' => $request->color
            ]);

            return response()->json(['msg' => 'Status created!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error creating status...'], 400);
        }
    }

    public function update(Request $request) {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|unique:statuses,name,' . $request->status,
            'color' => 'required|integer',
            'status' => 'required'
        ]);

        if($validator->fails()) {
            $failed = $validator->failed();

            if (isset($failed['name']))
                $msg = 'Status already exists!';
            else
                $msg = 'All fields required';

            return response()->json(['errors' => $validator->errors(),
                'msg' => $msg
            ], 400);
        }

        try {
            $status = Status::find($request->status);
            $status->name = $request->name;
            $status->color = $request->color;
            $status->save();

            return response()->json(['msg' => 'Status updated!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error updating status...'], 400);
        }
    }

    public function destroy(Request $request) {
        $request->validate([
            'id' => $request->status
        ]);

        try {
            $status = Status::find($request->status);
            $status->delete();
            return response()->json(['msg' => 'Status deleted!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error deleting status...'], 400);
        }
    }
}
