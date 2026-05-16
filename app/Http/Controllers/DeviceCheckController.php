<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceAssignment;
use App\Models\DeviceCheck;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class DeviceCheckController extends Controller
{

    public function __construct(
        private EmployeeService $employeeService,
    ){}
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

    public function checkDevice(int $employeeId, string $deviceId, string $inventoryNumber){

        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $employeeAssignment = DeviceAssignment::query()
            ->with('device')
            ->with('employee')
            ->where('employee_id', $employeeId)
            ->where('device_id', $deviceId)
            ->first();

        if (!$employeeAssignment) {
            return response()->json(['error' => 'Employee not assigned to the device'], 404);
        }

        if($employeeAssignment->device->inventory_number !== $inventoryNumber){
            DeviceCheck::query()->updateOrCreate([
                'device_assignment_id' => $employeeAssignment->id,
                'status' => 'missing',
            ]);
            return response()->json(['error' => 'Inventory number does not match'], 404);
        }else{
            DeviceCheck::query()->updateOrCreate([
                'device_assignment_id' => $employeeAssignment->id,
                'status' => 'present',
            ]);

            return response()->json(['success' => 'Device is present'], 200);
        }

    }
}
