<?php

namespace App\Http\Controllers;

use App\Services\DeviceAssignmentService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Device Assignments",
 *     description="Device Assignment API"
 * )
 */
class DeviceAssignmentController extends Controller
{
    public function __construct(
        private DeviceAssignmentService $deviceAssignmentService
    ){}

    /**
     * @OA\Get(
     *     path="/api/device-assignments",
     *     summary="Get all device assignments",
     *     tags={"Device Assignments"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of device assignments"
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

        $deviceAssignment = $this->deviceAssignmentService->getAll();

        return response()->json([
            'success' => true,
            'device_assignment' => $deviceAssignment,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/device-assignments",
     *     summary="Create device assignment",
     *     tags={"Device Assignments"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"device_id","employee_id","start_date","status"},
     *             @OA\Property(property="device_id", type="integer", example=1),
     *             @OA\Property(property="employee_id", type="integer", example=2),
     *             @OA\Property(property="start_date", type="string", format="date", example="2026-05-10"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2026-05-20"),
     *             @OA\Property(property="status", type="string", example="active")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Device assignment created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        $deviceAssignment = $this->deviceAssignmentService->create([
            'device_id' => $request->device_id,
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'device_assignment' => $deviceAssignment,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/device-assignments/{id}",
     *     summary="Get single device assignment",
     *     tags={"Device Assignments"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device Assignment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Device assignment found"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Device assignment not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function show($id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceAssignment = $this->deviceAssignmentService->find($id);

        return response()->json([
            'success' => true,
            'device_assignment' => $deviceAssignment,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/device-assignments/{id}",
     *     summary="Update device assignment",
     *     tags={"Device Assignments"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device Assignment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"device_id","employee_id"},
     *             @OA\Property(property="device_id", type="integer", example=1),
     *             @OA\Property(property="employee_id", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Device assignment updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Device assignment not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'employee_id' => 'required|exists:employees,id',
        ]);

        $deviceAssignment = $this->deviceAssignmentService->find($id);

        $this->deviceAssignmentService->update($deviceAssignment, [
            'device_id' => $request->device_id,
            'employee_id' => $request->employee_id,
        ]);

        return response()->json([
            'success' => true,
            'device_assignment' => $deviceAssignment,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/device-assignments/{id}",
     *     summary="Delete device assignment",
     *     tags={"Device Assignments"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device Assignment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Device assignment deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Device assignment not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceAssignment = $this->deviceAssignmentService->find($id);

        $this->deviceAssignmentService->delete($deviceAssignment);

        return response()->json([
            'success' => true,
        ]);
    }
}
