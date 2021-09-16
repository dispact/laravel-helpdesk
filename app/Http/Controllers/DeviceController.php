<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeviceController extends Controller
{
    public function index() {
        return view('devices.index');
    }

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
            'asset_tag' => 'required|string|unique:devices',
            'model' => 'nullable|int|exists:device_models,id',
            'building' => 'nullable|int|exists:buildings,id',
            'serial_number' => 'nullable|string|unique:devices,serial_number',
            'mac_address' => 'nullable|string|unique:devices,mac_address'
        ]);

        if ($validator->fails()) {
            $failed = $validator->failed();

            if (isset($failed['asset_tag']['Unique']))
                $msg = 'Asset tag already exists!';
            else if (isset($failed['serial_number']['Unique']))
                $msg = 'Serial number already exists!';
            else if (isset($failed['mac_address']['Unique']))
                $msg = 'MAC address already exists!';
            else
                $msg = 'Unexpected error occurred';

            return response()->json(['errors' => $validator->errors(),
                'msg' => $msg
            ], 400);
        }

        try {
            Device::create([
                'asset_tag' => $request->asset_tag,
                'model_id' => $request->model,
                'building_id' => $request->building,
                'serial_number' => $request->serial_number,
                'mac_address' => $request->mac_address
            ]);

            return response()->json(['msg' => 'Device added!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error adding device ..'], 400);
        }
    }

    public function update(Request $request) {
        $validator = \Validator::make($request->all(), [
            'og_asset' => 'required|string|exists:devices,asset_tag',
            'asset_tag' => [
                'required',
                'string',
                Rule::unique('devices')->ignore($request->og_asset, 'asset_tag')
            ],
            'model' => 'nullable|int|exists:device_models,id',
            'building' => 'nullable|int|exists:buildings,id',
            'serial_number' => [
                'nullable',
                'string',
                Rule::unique('devices')->ignore($request->og_asset, 'asset_tag')
            ],
            'mac_address' => [
                'nullable',
                'string',
                Rule::unique('devices')->ignore($request->og_asset, 'asset_tag')
            ]
        ]);

        if ($validator->fails()) {
            $failed = $validator->failed();

            if (isset($failed['asset_tag']['Unique']))
                $msg = 'Asset tag already exists!';
            else if (isset($failed['serial_number']['Unique']))
                $msg = 'Serial number already exists!';
            else if (isset($failed['mac_address']['Unique']))
                $msg = 'MAC address already exists!';
            else
                $msg = 'Unexpected error occurred';

            return response()->json(['errors' => $validator->errors(),
                'msg' => $msg
            ], 400);
        }

        try {
            $device = Device::find($request->og_asset);
            $device->asset_tag = $request->asset_tag;
            $device->model_id = $request->model;
            $device->building_id = $request->building;
            $device->serial_number = $request->serial_number;
            $device->mac_address = $request->mac_address;
            $device->save();

            return response()->json(['msg' => 'Device updated'], 200);
        } catch (\exception $e) {
            dd($e);
            return response()->json(['msg' => 'Error updating device...'], 400);
        }
    }

    public function destroy(Request $request) {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $user = Device::find($request->id);
            $user->delete();

            return response()->json(['msg' => 'Device deleted!'], 200);
        } catch (\exception $e) {
            return response()->json(['msg' => 'Error deleting device...'], 400);
        }
    }
}
