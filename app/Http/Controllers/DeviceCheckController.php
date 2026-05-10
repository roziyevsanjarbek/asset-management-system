<?php

namespace App\Http\Controllers;

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

    public function checkDevice(string $inventory_number){

        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceCheck = DeviceCheck::query()->where('inventory_number', $inventory_number)->first();

        if(!$deviceCheck){
            return response()->json([
                'success' => false,
                'message' => 'Device not found',
            ]);
        }

        return response()->json([
            'success' => true,
            'device_check' => $deviceCheck,
        ]);
    }
}
