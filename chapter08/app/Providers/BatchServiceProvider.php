<?php

declare(strict_types=1);

namespace App\Providers;

use App\Console\Commands\SendOrdersCommand;
use App\Services\ExportOrdersService;
use App\UseCases\SendOrdersUseCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Log\LogManager;
use Illuminate\Support\ServiceProvider;

class BatchServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SendOrdersCommand::class,
            function () {
                $useCase = app(SendOrdersUseCase::class);

                // ② send-orders 채널을 이용하도록 변경
                /** @var LogManager $logger */
                $logger = app(LogManager::class);
                return new SendOrdersCommand($useCase, $logger->channel('send-orders'));
            }
        );

        $this->app->bind(
            SendOrdersUseCase::class,
            function () {
                $service = $this->app->make(ExportOrdersService::class);
                $guzzle = new Client(
                    [
                        'handler' => tap(
                            HandlerStack::create(),
                            function (HandlerStack $v) {
                                $logger = app(LogManager::class);
                                $v->push(
                                    Middleware::log(
                                        $logger->driver('send-orders'),
                                        new MessageFormatter(
                                            ">>>\n{req_headers}\n<<<\n{res_headers}\n\n{res_body}"
                                        )
                                    )
                                );
                            }
                        )
                    ]
                );
                return new SendOrdersUseCase($service, $guzzle);
            }
        );
    }
}
