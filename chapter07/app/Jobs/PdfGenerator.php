<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Knp\Snappy\Pdf;

class PdfGenerator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path = '';

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    // handle 메서드의 인수에 타입 선언을 기술하면, 서비스 컨테이너에 정의한 객체가 전달됨
    public function handle(Pdf $pdf)
    {
        // html 형식으로 PDF 출력 지정
        $pdf->generateFromHtml(
            '<h1>Laravel</h1><p>Sample PDF Output.</p>',
            $this->path
        );
    }
}
