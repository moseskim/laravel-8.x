<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\UseCases\ExportOrdersUseCase;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class ExportOrdersCommand extends Command
{
    /** @var string */
    protected $signature = 'app:export-orders {date} {--output=}';

    /** @var string */
    protected $description = '구매 정보를 출력한다';

    /** @var ExportOrdersUseCase */
    private $useCase;

    public function __construct(ExportOrdersUseCase $useCase)
    {
        parent::__construct();

        $this->useCase = $useCase;
    }

    public function handle(): int
    {
        $date = $this->argument('date');
        $targetDate = CarbonImmutable::createFromFormat('Ymd', $date);

        $tsv = $this->useCase->run($targetDate);

        // ① output 옵션값 얻기
        $outputFilePath = $this->option('output');
        // ② null이면 경로를 지정하지 않았으므로 표준 출력 이용
        if (is_null($outputFilePath)) {
            echo $tsv;
            return 0;
        }

        // ③ 파일로 출력
        file_put_contents($outputFilePath, $tsv);
        return 0;
    }
}
