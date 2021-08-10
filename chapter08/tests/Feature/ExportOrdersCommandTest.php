<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;
use Tests\TestCase;

class ExportOrdersCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @var Kernel */
    private $artisan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan = app(Kernel::class);
        $this->seed();
    }

    /**
     * @test
     */
    public function execute()
    {
        $expected = file_get_contents(__DIR__ . '/export-orders-20210410.tsv');
        $this->expectOutputString($expected);

        $status = $this->artisan->call(
            'app:export-orders',
            [
                'date' => '20210410',
            ]
        );

        $this->assertSame(0, $status);
    }

    /**
     * @test
     */
    public function execute_구매_정보가_없음()
    {
        $expected = file_get_contents(__DIR__ . '/export-orders-no-orders.tsv');
        $this->expectOutputString($expected);

        $status = $this->artisan->call(
            'app:export-orders',
            [
                'date' => '20210420',
            ]
        );

        $this->assertSame(0, $status);
    }

    /**
     * @test
     */
    public function execute_인수가_없음()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Not enough arguments (missing: "date").');

        $this->artisan->call('app:export-orders');
    }

    /**
     * @test
     */
    public function execute_인수_지정이_잘못됨()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->artisan->call(
            'app:export-orders',
            [
                'date' => '2018-07-01',
            ]
        );
    }
}
