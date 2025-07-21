<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Herbal;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

/**
 * @OA\Tag(
 *     name="Herbals",
 *     description="Manajemen Herbal"
 * )
 */
class HerbalController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/herbals",
     *     tags={"Herbals"},
     *     summary="Ambil semua data herbal",
     *     @OA\Response(
     *         response=200,
     *         description="Daftar data herbal",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Herbal"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Herbal::all());
    }

    /**
     * @OA\Post(
     *     path="/api/herbals",
     *     tags={"Herbals"},
     *     summary="Tambah data herbal baru",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data herbal yang ingin ditambahkan",
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Kunyit"),
     *             @OA\Property(property="description", type="string", example="Bermanfaat untuk maag")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Data herbal berhasil ditambahkan",
     *         @OA\JsonContent(ref="#/components/schemas/Herbal")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $herbal = Herbal::create($validated);
        return response()->json($herbal, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/herbals/{id}",
     *     tags={"Herbals"},
     *     summary="Tampilkan detail herbal",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID dari herbal",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data herbal ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/Herbal")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show($id)
    {
        $herbal = Herbal::find($id);

        if (!$herbal) {
            return response()->json(['message' => 'Herbal not found'], 404);
        }

        return response()->json($herbal);
    }

    /**
     * @OA\Put(
     *     path="/api/herbals/{id}",
     *     tags={"Herbals"},
     *     summary="Update data herbal",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID herbal yang akan diperbarui",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Jahe Merah"),
     *             @OA\Property(property="description", type="string", example="Meningkatkan daya tahan tubuh")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/Herbal")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function update(Request $request, $id)
    {
        $herbal = Herbal::find($id);

        if (!$herbal) {
            return response()->json(['message' => 'Herbal not found'], 404);
        }

        $herbal->update($request->only(['name', 'description']));
        return response()->json($herbal);
    }

    /**
     * @OA\Delete(
     *     path="/api/herbals/{id}",
     *     tags={"Herbals"},
     *     summary="Hapus data herbal",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID dari herbal",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Data berhasil dihapus"
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $herbal = Herbal::find($id);

        if (!$herbal) {
            return response()->json(['message' => 'Herbal not found'], 404);
        }

        $herbal->delete();
        return response()->noContent();
    }
}
