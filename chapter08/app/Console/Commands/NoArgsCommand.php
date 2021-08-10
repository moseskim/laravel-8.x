<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NoArgsCommand extends Command
{
    const PATH = '/tmp/no-args-command';

    /** @var string */
    protected $signature = 'no-args-command';

    /** @var string */
    protected $description = '인수가 없는 명령어';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        file_put_contents(self::PATH, 'no-args');

        return 0;
    }
}
