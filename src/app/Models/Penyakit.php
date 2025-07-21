<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    /**
     * @OA\Schema(
     *     schema="Penyakit",
     *     type="object",
     *     title="Penyakit",
     *     required={"id", "name"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="name", type="string", example="Demam"),
     *     @OA\Property(property="description", type="string", example="Suhu tubuh meningkat")
     * )
     */

class Penyakit extends Model
{
    protected $fillable = ['name', 'description', 'symptoms'];

    public function herbals()
    {
        return $this->belongsToMany(Herbal::class, 'penyakit_herbal') // <- nama pivot disebutkan eksplisit
                    ->withTimestamps()
                    ->withPivot('notes');
    }
}