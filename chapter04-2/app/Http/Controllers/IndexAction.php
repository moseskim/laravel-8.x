<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

final class IndexAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            [
                '_embedded' => [
                    'routes' => [
                        [
                            "_links" => [
                                'self' => [
                                    'href' => 'https://127.0.0.1/article',
                                ]
                            ],
                            'title' => 'article'
                        ],
                        [
                            "_links" => [
                                'self' => [
                                    'href' => 'https://127.0.0.1/text',
                                ]
                            ],
                            'title' => 'text'
                        ],
                        [
                            "_links" => [
                                'self' => [
                                    'href' => 'https://127.0.0.1/view',
                                ]
                            ],
                            'title' => 'view'
                        ],
                        [
                            "_links" => [
                                'self' => [
                                    'href' => 'https://127.0.0.1/download',
                                ]
                            ],
                            'title' => 'download'
                        ],
                        [
                            "_links" => [
                                'self' => [
                                    'href' => 'https://127.0.0.1/json',
                                ]
                            ],
                            'title' => 'json'
                        ],
                        [
                            "_links" => [
                                'self' => [
                                    'href' => 'https://127.0.0.1/jsonp',
                                ]
                            ],
                            'title' => 'jsonp'
                        ],
                        [
                            "_links" => [
                                'self' => [
                                    'href' => 'https://127.0.0.1/media',
                                ]
                            ],
                            'title' => 'media'
                        ],
                        [
                            "_links" => [
                                'self' => [
                                    'href' => 'https://127.0.0.1/stream',
                                ]
                            ],
                            'title' => 'stream'
                        ],
                    ]
                ]
            ]
        );
    }
}