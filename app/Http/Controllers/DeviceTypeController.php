<?php

namespace App\Http\Controllers;

use App\Services\DeviceTypeService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Device Types",
 *     description="API Endpoints for Device Types"
 * )
 */
class DeviceTypeController extends Controller
{
    public function __construct(
        private readonly DeviceTypeService $deviceTypeService,
    ){}

    /**
     * @OA\Get(
     *     path="/api/device-types",
     *     summary="Get all device types",
     *     tags={"Device Types"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of device types"
     *     ),
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

        $deviceTypes = $this->deviceTypeService->getAll();
        return response()->json($deviceTypes);
    }

    /**
     * @OA\Post(
     *     path="/api/device-types",
     *     summary="Create new device type",
     *     tags={"Device Types"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Laptop")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Device type created",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="device_type", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceType = $this->deviceTypeService->create($request->name);

        return response()->json([
            'success' => true,
            'device_type' => $deviceType,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/device-types/{id}",
     *     summary="Get device type by ID",
     *     tags={"Device Types"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Device type detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function show($id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceType = $this->deviceTypeService->find($id);
        return response()->json($deviceType);
    }


    /**
     * @OA\Put(
     *     path="/api/device-types/{id}",
     *     summary="Update device type",
     *     tags={"Device Types"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Monitor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated successfully"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceType = $this->deviceTypeService->find($id);
        $this->deviceTypeService->update($deviceType, $request->all());

        return response()->json([
            'success' => true,
            'device_type' => $deviceType,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/device-types/{id}",
     *     summary="Delete device type",
     *     tags={"Device Types"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceType = $this->deviceTypeService->find($id);
        $deviceType->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
