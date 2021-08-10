<?php

declare(strict_types=1);

namespace App\Providers;

use Knp\Snappy\Pdf;
use App\DataProvider\RegisterReviewProviderInterface;
use App\DataProvider\Database\RegisterReviewDataProvider;
use App\Foundation\ElasticsearchClient;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            Pdf::class,
            function () {
                return new Pdf('/usr/bin/wkhtmltopdf');
            }
        );
        $this->app->bind(
            RegisterReviewProviderInterface::class,
            function (Application $app) {
                return new RegisterReviewDataProvider($app->make('db'));
            }
        );

        $this->app->singleton(
            ElasticsearchClient::class,
            function (Application $app) {
                $config = $app['config']->get('elasticsearch');
                return new ElasticsearchClient($config['hosts']);
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
