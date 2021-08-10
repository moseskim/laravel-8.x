<?php

namespace App\Providers;

use App\Foundation\ViewComposer\PolicyComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Factory $factory)
    {
        // 리스트 6.5.3.4 View Composer 등록 예
        /*
        $factory->composer(
            'PolicyComposer를 이용할 템플릿명',
            PolicyComposer::class
        );
        */
    }
}
