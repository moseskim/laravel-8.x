<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\UseCases\SendOrdersUseCase;
use Carbon\CarbonImmutable;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

class SendOrdersCommand extends Command
{
    /** @var string */
    protected $signature = 'app:send-orders {date}';

    /** @var string */
    protected $description = '구매 정보를 송신한다';

    /** @var SendOrdersUseCase */
    private $useCase;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(SendOrdersUseCase $useCase, LoggerInterface $logger)
    {
        parent::__construct();

        $this->useCase = $useCase;
        $this->logger = $logger;
    }

    /**
     * @throws GuzzleException
     */
    public function handle(): int
    {
        // ② 배치 처리 시작 로그
        $this->logger->info(__METHOD__ . ' ' . 'start');
        $date = $this->argument('date');
        $targetDate = CarbonImmutable::createFromFormat('Ymd', $date);

        // ③ 배치 명령어 인수 출력
        $this->logger->info('TargetDate:' . $date);
        $count = $this->useCase->run($targetDate);

        // ④ 배치 처리 종료 로그
        $this->logger->info(__METHOD__ . ' ' . 'done sent_count:' . $count);

        return 0;
    }
}
