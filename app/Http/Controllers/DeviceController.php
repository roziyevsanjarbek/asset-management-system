<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\DeviceService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Devices",
 *     description="Device management endpoints"
 * )
 */
class DeviceController extends Controller
{
    public function __construct(
        private DeviceService $deviceService,
    ){}

    /**
     * @OA\Get(
     *     path="/api/devices",
     *     summary="Get all devices",
     *     tags={"Devices"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of devices",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="device",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="device_type_id", type="integer", example=1),
     *                     @OA\Property(property="serial_number", type="string", example="SN123456"),
     *                     @OA\Property(property="inventory_number", type="string", example="INV001"),
     *                     @OA\Property(property="name", type="string", example="HP Laptop")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $device = $this->deviceService->getAll();

        return response()->json([
            'success' => true,
            'device' => $device,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/devices",
     *     summary="Create device",
     *     tags={"Devices"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"device_type_id","serial_number","inventory_number","name"},
     *
     *             @OA\Property(property="device_type_id", type="integer", example=1),
     *             @OA\Property(property="serial_number", type="string", example="SN123456"),
     *             @OA\Property(property="inventory_number", type="string", example="INV001"),
     *             @OA\Property(property="name", type="string", example="HP Laptop")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Device created",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_type_id' => 'required|exists:device_types,id',
            'serial_number' => 'required|string|max:255',
            'inventory_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $device = $this->deviceService->create([
            'device_type_id' => $request->device_type_id,
            'serial_number' => $request->serial_number,
            'inventory_number' => $request->inventory_number,
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'device' => $device,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/devices/{id}",
     *     summary="Get single device",
     *     tags={"Devices"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Device details",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Device not found"
     *     )
     * )
     */
    public function show($id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $device = $this->deviceService->find($id);

        return response()->json([
            'success' => true,
            'device' => $device,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/devices/{id}",
     *     summary="Update device",
     *     tags={"Devices"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"device_type_id","serial_number","inventory_number","name"},
     *
     *             @OA\Property(property="device_type_id", type="integer", example=1),
     *             @OA\Property(property="serial_number", type="string", example="SN123456"),
     *             @OA\Property(property="inventory_number", type="string", example="INV001"),
     *             @OA\Property(property="name", type="string", example="HP Laptop")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Device updated",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true)
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'device_type_id' => 'required|exists:device_types,id',
            'serial_number' => 'required|string|max:255',
            'inventory_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $device = $this->deviceService->find($id);

        $this->deviceService->update($device, [
            'device_type_id' => $request->device_type_id,
            'serial_number' => $request->serial_number,
            'inventory_number' => $request->inventory_number,
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'device' => $device,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/devices/{id}",
     *     summary="Delete device",
     *     tags={"Devices"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Device deleted",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true)
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $device = $this->deviceService->find($id);

        $this->deviceService->delete($device);

        return response()->json([
            'success' => true,
        ]);
    }
}
