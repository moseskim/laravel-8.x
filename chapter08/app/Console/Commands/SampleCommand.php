<?php

namespace App\Console\Commands;

use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class SampleCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:sample';

    public function handle(): int
    {
        $now = CarbonImmutable::now()->toDateTimeString();
        file_put_contents('/tmp/sample.log', $now . PHP_EOL, FILE_APPEND);
        return 0;
    }
}
