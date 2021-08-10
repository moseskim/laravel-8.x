<?php

declare(strict_types=1);

namespace App\DataProvider\Elasticsearch;

use App\Foundation\ElasticsearchClient;

use function array_map;
use function count;

class ReadReviewDataProvider
{
    private $client;

    /**
     * @param ElasticsearchClient $client
     */
    public function __construct(
        ElasticsearchClient $client
    ) {
        $this->client = $client;
    }

    /**
     * @param array $tags
     *
     * @return array
     */
    public function findAllByTag(array $tags): array
    {
        $result = $this->client->client()->search(
            [
                "index" => 'reviews',
                "body" => [
                    "query" => [
                        'nested' => [
                            'path' => 'tags',
                            'query' => [
                                'bool' => [
                                    'should' => array_map(
                                        function (string $value) {
                                            return [
                                                'term' => [
                                                    'tags.tag_name' => $value
                                                ]
                                            ];
                                        },
                                        $tags
                                    ),
                                ]
                            ]
                        ]
                    ],
                ],
            ]
        );
        $map = [];
        if (count($result)) {
            foreach ($result['hits']['hits'] as $hit) {
                $map[] = $hit['_source'];
            }
        }
        return $map;
    }
}
