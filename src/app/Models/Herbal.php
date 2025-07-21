<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Herbal",
 *     type="object",
 *     title="Herbal",
 *     required={"id", "nama", "manfaat"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama", type="string", example="Daun Kelor"),
 *     @OA\Property(property="manfaat", type="string", example="Menurunkan tekanan darah")
 * )
 */

class Herbal extends Model
{
    protected $fillable = ['name', 'description', 'benefits', 'image_url'];

    public function penyakits()
    {
        return $this->belongsToMany(Penyakit::class, 'penyakit_herbal') // <- sebutkan nama pivot tabel
                    ->withTimestamps()
                    ->withPivot('notes');
    }
}