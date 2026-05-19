<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Companies",
 *     description="Company management endpoints"
 * )
 */
class CompanyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/companies",
     *     summary="Get all companies",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Companies list",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="EGS"),
     *                 @OA\Property(property="created_at", type="string", example="2026-05-19T10:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", example="2026-05-19T10:00:00.000000Z")
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

        $companies = Company::query()->get();

        return response()->json($companies);
    }

    /**
     * @OA\Post(
     *     path="/api/companies",
     *     summary="Create company",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name"},
     *
     *             @OA\Property(property="name", type="string", example="INCOTRUCK")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Company created",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="INCOTRUCK")
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

        $company = Company::query()->create($request->all());

        return response()->json($company, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/companies/{id}",
     *     summary="Get single company",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Company ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Company details",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="EGS")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Company not found"
     *     ),
     *
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

        $company = Company::query()->findOrFail($id);

        return response()->json($company);
    }

    /**
     * @OA\Put(
     *     path="/api/companies/{id}",
     *     summary="Update company",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Company ID",
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
     *             @OA\Property(property="name", type="string", example="ESTLINE")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Company updated",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="ESTLINE")
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
     *         description="Company not found"
     *     ),
     *
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
            'name' => 'required|string|max:255',
        ]);

        $company = Company::query()->findOrFail($id);

        $company->update($request->all());

        return response()->json($company);
    }

    /**
     * @OA\Delete(
     *     path="/api/companies/{id}",
     *     summary="Delete company",
     *     tags={"Companies"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Company ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=204,
     *         description="Company deleted"
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Company not found"
     *     ),
     *
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

        $company = Company::query()->findOrFail($id);

        $company->delete();

        return response()->json('Company Delete', 204);
    }
}
