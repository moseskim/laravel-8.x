<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WithArgsCommand extends Command
{
    const PATH = '/tmp/some-command';

    /** @var string */
    protected $signature = 'with-args-command {name?} {--switch}';

    /** @var string */
    protected $description = '인수가 있는 명령어';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $message = '';
        $message .= $this->argument('name') . "\n";
        $message .= $this->option('switch') ? 'ON' : 'OFF';
        file_put_contents(self::PATH, $message);

        return 0;
    }
}
