<?php

declare(strict_types=1);

namespace App\Providers;

use App\Foundation\ElasticsearchClient;
use Fluent\Logger\FluentLogger;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\ElasticsearchHandler;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // 리스트 10.2.3.3 Monolog\Handler\ElasticSearchHandler 클래스 등록
        $this->app->singleton(
            ElasticsearchHandler::class,
            function (Application $app) {
                return new ElasticsearchHandler(
                    $app->make(ElasticsearchClient::class)->client()
                );
            }
        );
        // 리스트 10.1.4.2 Fluent\Logger\FluentLogger 클래스 등록
        $this->app->singleton(
            FluentLogger::class,
            function () {
                // 실제 이용할 때는 .env 파일 등에서 서버 주소와 port를 지정
                return new FluentLogger('localhost', 24224);
            }
        );
    }
}
