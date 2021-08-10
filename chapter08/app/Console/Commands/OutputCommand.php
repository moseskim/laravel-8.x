<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Output\OutputInterface;

class OutputCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'output';
    /**
     * @var string
     */
    protected $description = '출력 테스트';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function handle(): int
    {
        $this->info('quiet', OutputInterface::VERBOSITY_QUIET);
        $this->info('normal', OutputInterface::VERBOSITY_NORMAL);
        $this->info('verbose', OutputInterface::VERBOSITY_VERBOSE);
        $this->info('very_verbose', OutputInterface::VERBOSITY_VERY_VERBOSE);
        $this->info('debug', OutputInterface::VERBOSITY_DEBUG);
        return 0;
    }
}
