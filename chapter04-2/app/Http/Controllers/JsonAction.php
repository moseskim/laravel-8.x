<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use function response;

final class JsonAction extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $response = Response::json(['status' => 'success']);
        // 헬퍼 함수 이용 시
        $response = response()->json(['status' => 'success']);
        return $response;
    }
}
