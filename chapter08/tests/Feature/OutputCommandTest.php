<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Contracts\Console\Kernel;
use Tests\TestCase;

class OutputCommandTest extends TestCase
{
    /** @var Kernel */
    private $artisan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan = app(Kernel::class);
    }

    /**
     * @test
     */
    public function output()
    {
        $expected = <<<EOT
quiet
normal

EOT;

        $status = $this->artisan->call('output');

        $this->assertSame(0, $status);
        $this->assertSame($expected, $this->artisan->output());
    }

    /**
     * @test
     */
    public function output_quiet()
    {
        $expected = <<<EOT
quiet

EOT;

        $status = $this->artisan->call(
            'output',
            [
                '--quiet' => true,
            ]
        );

        $this->assertSame(0, $status);
        $this->assertSame($expected, $this->artisan->output());
    }

    /**
     * @test
     */
    public function output_v()
    {
        $expected = <<<EOT
quiet
normal
verbose

EOT;

        $status = $this->artisan->call(
            'output',
            [
                '-v' => true,
            ]
        );

        $this->assertSame(0, $status);
        $this->assertSame($expected, $this->artisan->output());
    }

    /**
     * @test
     */
    public function output_vv()
    {
        $expected = <<<EOT
quiet
normal
verbose
very_verbose

EOT;

        $status = $this->artisan->call(
            'output',
            [
                '-vv' => true,
            ]
        );

        $this->assertSame(0, $status);
        $this->assertSame($expected, $this->artisan->output());
    }

    /**
     * @test
     */
    public function output_vvv()
    {
        $expected = <<<EOT
quiet
normal
verbose
very_verbose
debug

EOT;

        $status = $this->artisan->call(
            'output',
            [
                '-vvv' => true,
            ]
        );

        $this->assertSame(0, $status);
        $this->assertSame($expected, $this->artisan->output());
    }
}
