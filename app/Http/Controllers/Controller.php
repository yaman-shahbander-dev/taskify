<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Taskify API",
 *     description="API Documentation",
 *     @OA\Contact(
 *         email="support@yaman.com"
 *     ),
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */
abstract class Controller
{
    //
}
