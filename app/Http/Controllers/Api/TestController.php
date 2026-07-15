<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class TestController extends Controller
{
    #[OA\Get(
        path: "/api/test",
        summary: "Tester Swagger",
        tags: ["Test"],
        responses: [
            new OA\Response(
                response: 200,
                description: "API fonctionnelle"
            )
        ]
    )]
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Swagger fonctionne !'
        ]);
    }
}