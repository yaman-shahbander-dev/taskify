<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Test API",
 *     description="API Documentation Test",
 *     @OA\Contact(
 *         email="support@mysite.com"
 *     ),
 *     @OA\License(
 *         name="Proprietary",
 *         url=""
 *     )
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */
class TestController extends Controller
{
    /**
     * @OA\Get(
     *     path="/test",
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function test(): string
    {
        return "test";
    }
}
