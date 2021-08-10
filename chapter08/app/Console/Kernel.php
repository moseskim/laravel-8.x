<?php

namespace App\Console;

use App\Console\Commands\SendOrdersCommand;
use Carbon\CarbonImmutable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command(SampleCommand::class) // ① 실향 Command 클래스
//                ->description('샘플 마스터') // ② 태스크 설명
//                ->everyMinute();

        $schedule->
            command(
                SendOrdersCommand::class,
                [CarbonImmutable::yesterday()->format('Ymd')]
            )
            ->dailyAt('05:00')
            ->description('購入情報の送信')
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
