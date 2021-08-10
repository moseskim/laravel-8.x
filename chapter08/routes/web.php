<?php

use App\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

# 인수 없음
Route::get('/no_args', function () {
    Artisan::call('no-args-command');
});

# 인수 있음
Route::get('/with_args', function () {
    Artisan::call('with-args-command', [
        'name' => 'Johann',
        '--switch' => true,
    ]);

    // 다음과 같이 명령어명 뒤에 인수를 문자열로 지정할 수도 있음
    // Artisan::call('with-args-command Johann --switch');
});

Route::get('/no_args_di', function (Kernel $artisan) {
    $artisan->call('no-args-command');
});
