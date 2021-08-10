<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

use function flush;
use function ob_flush;
use function rand;
use function usleep;

final class StreamAction extends Controller
{
    public function __invoke(): StreamedResponse
    {
        return response()->stream(
            function () {
                while (true) {
                    echo 'data: ' . rand(1, 100) . "\n\n";
                    ob_flush();
                    flush();
                    usleep(200000);
                }
            },
            Response::HTTP_OK,
            [
                'content-type' => 'text/event-stream',
                'X-Accel-Buffering' => 'no',
                'Cache-Control' => 'no-cache',
            ]
        );
    }
}
