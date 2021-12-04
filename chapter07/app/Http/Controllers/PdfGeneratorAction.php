<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\PdfGenerator;
use Illuminate\Contracts\Bus\Dispatcher;

use function dispatch;

final class PdfGeneratorAction extends Controller
{
    private $dispatcher;

    public function __construct(
        Dispatcher $dispatcher
    ) {
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(): void
    {
        $generator = new PdfGenerator(storage_path('pdf/sample.pdf'));
        // 1) 컨스트럭터 인젝션을 이용해
        //  Illuminate\Contracts\Bus\Dispatcher 인터페이스의
        //  dispatch 메서서드로 실행 지시
        // Bus 퍼사드를 이용해 기술할 수도 있음
        $this->dispatcher->dispatch($generator);
        // (2) Illuminate\Foundation\Bus\DispatchesJobs 트레이트를 경유해
        //  dispatch 이용 가능
        $this->dispatch($generator);
        // (3) dispatch 헬퍼 함수로 실행 지시
        dispatch($generator);
    }
}
