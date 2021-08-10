<?php

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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::get(
    '/dashboard',
    function () {
        return view('dashboard');
    }
)->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/register', \App\Http\Controllers\Register\RegisterAction::class);
Route::get('/register/callback', \App\Http\Controllers\Register\CallbackAction::class);

Route::get('/a', function(\Illuminate\Contracts\Auth\Access\Gate $gate) {
    dd($gate->allows('user-access', 2));
});
