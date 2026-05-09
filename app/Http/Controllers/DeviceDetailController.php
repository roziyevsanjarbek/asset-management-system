<?php

namespace App\Http\Controllers;

use App\Models\DeviceDetail;
use App\Services\DeviceDetailService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Device Details",
 *     description="Device detail management endpoints"
 * )
 */
class DeviceDetailController extends Controller
{
    public function __construct(
        private DeviceDetailService $deviceDetailService
    )
    {
    }

    /**
     * @OA\Get(
     *     path="/api/device-details",
     *     summary="Get all device details",
     *     tags={"Device Details"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of device details",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *
     *             @OA\Property(
     *                 property="device_detail",
     *                 type="array",
     *
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="device_id", type="integer", example=1),
     *                     @OA\Property(property="key", type="string", example="RAM"),
     *                     @OA\Property(property="value", type="string", example="16GB")
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

        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceDetail = $this->deviceDetailService->getAll();

        return response()->json([
            'success' => true,
            'device_detail' => $deviceDetail,
        ]);

    }

    /**
     * @OA\Post(
     *     path="/api/device-details",
     *     summary="Create device detail",
     *     tags={"Device Details"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"device_id","key","value"},
     *
     *             @OA\Property(property="device_id", type="integer", example=1),
     *             @OA\Property(property="key", type="string", example="RAM"),
     *             @OA\Property(property="value", type="string", example="16GB")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Device detail created",
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
            'device_id' => 'required|exists:devices,id',
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);


        $user = auth()->user();

        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceDetail = $this->deviceDetailService->create([
            'device_id' => $request->device_id,
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return response()->json([
            'success' => true,
            'device_detail' => $deviceDetail,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/device-details/{id}",
     *     summary="Get single device detail",
     *     tags={"Device Details"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device Detail ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Device detail information",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Device detail not found"
     *     )
     * )
     */
    public function show($id)
    {

        $user = auth()->user();

        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceDetail = $this->deviceDetailService->find($id);

        return response()->json([
            'success' => true,
            'device_detail' => $deviceDetail,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/device-details/{id}",
     *     summary="Update device detail",
     *     tags={"Device Details"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device Detail ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"device_id","key","value"},
     *
     *             @OA\Property(property="device_id", type="integer", example=1),
     *             @OA\Property(property="key", type="string", example="RAM"),
     *             @OA\Property(property="value", type="string", example="16GB")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Device detail updated",
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
            'device_id' => 'required|exists:devices,id',
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceDetail = $this->deviceDetailService->find($id);

        $this->deviceDetailService->update($deviceDetail,[
            'device_id' => $request->device_id,
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return response()->json([
            'success' => true,
            'device_detail' => $deviceDetail,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/device-details/{id}",
     *     summary="Delete device detail",
     *     tags={"Device Details"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Device Detail ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Device detail deleted",
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

        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $deviceDetail = $this->deviceDetailService->find($id);

        $this->deviceDetailService->delete($deviceDetail);

        return response()->json([
            'success' => true,
        ]);
    }
}
