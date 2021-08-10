<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Console\Kernel;
use App\Services\ExportOrdersService;
use App\UseCases\SendOrdersUseCase;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Psr\Http\Message\RequestInterface;
use Tests\TestCase;

class SendOrdersCommandTest extends TestCase
{
    use RefreshDatabase;

    const OUTPUT_PATH = '/tmp/orders';

    /** @var Kernel */
    private $artisan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan = app(Kernel::class);
        $this->seed();

        $this->app->bind(
            SendOrdersUseCase::class,
            function () {
                $service = $this->app->make(ExportOrdersService::class);
                $guzzle = new Client(
                    [
                        'handler' => function (RequestInterface $request) {
                            $this->assertSame('POST', $request->getMethod(), __FILE__ . ':' . __LINE__);
                            $this->assertSame(
                                '/api/import-orders',
                                $request->getUri()->getPath(),
                                __FILE__ . ':' . __LINE__
                            );

                            file_put_contents(self::OUTPUT_PATH, $request->getBody()->getContents());

                            return new FulfilledPromise(new Response());
                        }
                    ]
                );

                return new SendOrdersUseCase($service, $guzzle);
            }
        );

        @unlink('/tmp/orders');
    }

    /**
     * @test
     */
    public function execute()
    {
        $status = $this->artisan->call(
            'app:send-orders',
            [
                'date' => '20210410',
            ]
        );

        $this->assertSame(0, $status);
        $this->assertJsonFileEqualsJsonFile(__DIR__ . '/send-orders-20210410.json', self::OUTPUT_PATH);
    }

    /**
     * @test
     */
    public function execute_20180630()
    {
        $status = $this->artisan->call(
            'app:send-orders',
            [
                'date' => '20210411',
            ]
        );

        $this->assertSame(0, $status);
        $this->assertJsonFileEqualsJsonFile(__DIR__ . '/send-orders-20210411.json', self::OUTPUT_PATH);
    }
}
