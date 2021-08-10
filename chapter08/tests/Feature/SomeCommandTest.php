<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Console\Commands\NoArgsCommand;
use App\Console\Commands\WithArgsCommand;
use Tests\TestCase;

class SomeCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        @unlink(WithArgsCommand::PATH);
    }

    /**
     * @test
     */
    public function get_no_args()
    {
        $this->get('/no_args')
            ->assertStatus(200);

        $this->assertSame("no-args", file_get_contents(NoArgsCommand::PATH));
    }

    /**
     * @test
     */
    public function get_with_args()
    {
        $this->get('/with_args')
            ->assertStatus(200);

        $this->assertSame("Johann\nON", file_get_contents(WithArgsCommand::PATH));
    }

    /**
     * @test
     */
    public function get_no_args_di()
    {
        $this->get('/no_args_di')
            ->assertStatus(200);

        $this->assertSame("no-args", file_get_contents(NoArgsCommand::PATH));
    }
}
