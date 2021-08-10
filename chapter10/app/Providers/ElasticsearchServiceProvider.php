<?php

declare(strict_types=1);

namespace App\Providers;

use App\Foundation\ElasticsearchClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\ElasticsearchHandler;

final class ElasticsearchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            ElasticsearchClient::class,
            function (Application $app) {
                $config = $app['config']->get('elasticsearch');
                return new ElasticsearchClient($config['hosts']);
            }
        );
    }
}
