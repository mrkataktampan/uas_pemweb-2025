<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

/**
 * @OA\Tag(
 *     name="Penyakits",
 *     description="Manajemen data penyakit"
 * )
 */
class PenyakitController extends Controller
{
    /**
     * Get all penyakit
     *
     * @OA\Get(
     *     path="/api/penyakits",
     *     tags={"Penyakits"},
     *     summary="Ambil semua data penyakit",
     *     @OA\Response(
     *         response=200,
     *         description="Daftar data penyakit",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Penyakit"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Penyakit::all());
    }

    /**
     * Create new penyakit
     *
     * @OA\Post(
     *     path="/api/penyakits",
     *     tags={"Penyakits"},
     *     summary="Tambah data penyakit baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Demam"),
     *             @OA\Property(property="description", type="string", example="Suhu tubuh meningkat")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Penyakit berhasil ditambahkan",
     *         @OA\JsonContent(ref="#/components/schemas/Penyakit")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $penyakit = Penyakit::create($validated);
        return response()->json($penyakit, 201);
    }

    /**
     * Get penyakit by ID
     *
     * @OA\Get(
     *     path="/api/penyakits/{id}",
     *     tags={"Penyakits"},
     *     summary="Tampilkan detail penyakit berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID penyakit",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/Penyakit")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show($id)
    {
        $penyakit = Penyakit::find($id);

        if (!$penyakit) {
            return response()->json(['message' => 'Penyakit not found'], 404);
        }

        return response()->json($penyakit);
    }

    /**
     * Update penyakit by ID
     *
     * @OA\Put(
     *     path="/api/penyakits/{id}",
     *     tags={"Penyakits"},
     *     summary="Perbarui data penyakit",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID penyakit yang ingin diperbarui",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Flu Berat"),
     *             @OA\Property(property="description", type="string", example="Flu dengan gejala berat")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil diperbarui",
     *         @OA\JsonContent(ref="#/components/schemas/Penyakit")
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function update(Request $request, $id)
    {
        $penyakit = Penyakit::find($id);

        if (!$penyakit) {
            return response()->json(['message' => 'Penyakit not found'], 404);
        }

        $penyakit->update($request->only(['name', 'description']));
        return response()->json($penyakit);
    }

    /**
     * Delete penyakit
     *
     * @OA\Delete(
     *     path="/api/penyakits/{id}",
     *     tags={"Penyakits"},
     *     summary="Hapus data penyakit berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID penyakit",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Berhasil dihapus"),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $penyakit = Penyakit::find($id);

        if (!$penyakit) {
            return response()->json(['message' => 'Penyakit not found'], 404);
        }

        $penyakit->delete();
        return response()->noContent();
    }
}