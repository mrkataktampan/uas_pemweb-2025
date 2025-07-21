<?php

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OA;

/**
 * @OA\Info(
 *     title="Herbal API Documentation",
 *     version="1.0.0",
 *     description="Dokumentasi lengkap API Aplikasi Penyembuhan Herbal."
 * )
 *
 * @OA\Server(
 *     url="https://uas_pemweb.test/",
 *     description="API Server"
 * )
 */
class SwaggerController
{
    // Controller ini hanya digunakan untuk mendefinisikan metadata Swagger.
}
