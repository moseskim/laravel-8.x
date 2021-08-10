<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use function response;

final class MediaAction extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(
            ['message' => 'laravel'],
            Response::HTTP_OK,
            [
                'content-type' => 'application/vnd.laravel-api+json'
            ]
        );
    }
}
