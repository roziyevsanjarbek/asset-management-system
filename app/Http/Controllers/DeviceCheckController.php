<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceAssignment;
use App\Models\DeviceCheck;
use Illuminate\Http\Request;

class DeviceCheckController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceCheck = DeviceCheck::query()->with('deviceAssignment')->get();

        return response()->json([
            'success' => true,
            'device_check' => $deviceCheck,
        ]);
    }

    public function store(Request $request)
    {

    }

    public function checkDevice(int $employeeId, string $inventoryNumber){

        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $device = Device::query()->where('inventory_number', $inventoryNumber)->first();

        if(!$device){
            return response()->json([
                'success' => false,
                'message' => 'Device not found',
            ]);
        }
        $deviceAssignment = DeviceAssignment::query()
            ->where('device_id', $device->id)
            ->where('employee_id', $employeeId)
            ->first();

        if(!$deviceAssignment){
            return response()->json([
                'success' => false,
                'message' => 'Device not assigned',
            ]);
        }

        $deviceCheck = DeviceCheck::query()->create([
            'device_assignment_id' => $deviceAssignment->id,
            'check_date' => now(),
            'status' => 'present',
        ]);

        return response()->json([
            'success' => true,
            'device_check' => $deviceCheck,
        ]);
    }
}
