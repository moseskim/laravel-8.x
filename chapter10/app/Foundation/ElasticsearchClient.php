<?php

declare(strict_types=1);

namespace App\Foundation;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

/**
 * Class ElasticsearchClient
 */
class ElasticsearchClient
{
    /** @var array */
    protected $hosts = [];

    /**
     * ElasticseachClient constructor.
     *
     * @param array $hosts
     */
    public function __construct(array $hosts)
    {
        $this->hosts = $hosts;
    }

    /**
     * @return Client
     */
    public function client(): Client
    {
        return ClientBuilder::create()
            ->setHosts($this->hosts)
            ->build();
    }
}
