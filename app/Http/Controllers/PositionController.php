<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Positions",
 *     description="Position management endpoints"
 * )
 */
class PositionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/positions",
     *     summary="Get all positions",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Positions list",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="positions",
     *                 type="array",
     *
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Manager"),
     *                     @OA\Property(property="created_at", type="string", example="2026-05-19T10:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", example="2026-05-19T10:00:00.000000Z")
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

        $positions = Position::query()->get();

        return response()->json([
            'success' => true,
            'positions' => $positions,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/positions",
     *     summary="Create position",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name"},
     *
     *             @OA\Property(property="name", type="string", example="Manager")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Position created",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *
     *             @OA\Property(
     *                 property="position",
     *                 type="object",
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Manager")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *
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
            'name' => 'required|string|max:255',
        ]);

        $position = Position::query()->create($request->all());

        return response()->json([
            'success' => true,
            'position' => $position,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/positions/{positionId}",
     *     summary="Get single position",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="positionId",
     *         in="path",
     *         required=true,
     *         description="Position ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Position details",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *
     *             @OA\Property(
     *                 property="position",
     *                 type="object",
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Manager")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Position not found"
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function show($positionId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $position = Position::query()->findOrFail($positionId);

        return response()->json([
            'success' => true,
            'position' => $position,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/positions/{positionId}",
     *     summary="Update position",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="positionId",
     *         in="path",
     *         required=true,
     *         description="Position ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name"},
     *
     *             @OA\Property(property="name", type="string", example="Senior Manager")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Position updated",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *
     *             @OA\Property(
     *                 property="position",
     *                 type="object",
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Senior Manager")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Position not found"
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function update(Request $request, $positionId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $position = Position::query()->findOrFail($positionId);

        $position->update($request->all());

        return response()->json([
            'success' => true,
            'position' => $position,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/positions/{positionId}",
     *     summary="Delete position",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="positionId",
     *         in="path",
     *         required=true,
     *         description="Position ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Position deleted",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Position not found"
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function destroy($positionId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $position = Position::query()->findOrFail($positionId);

        $position->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
