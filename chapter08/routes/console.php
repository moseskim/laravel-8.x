<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('hello:closure', function () {
    $this->comment('Hello closure command');  // ① 문자열 출력
    return 0;                                 // ② 정상 종료이면 0을 반환
})->describe('샘플 명령어(클로저)');            // ③ 명령어 설명
