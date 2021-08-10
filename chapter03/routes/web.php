<?php

use Illuminate\Support\Facades\Route;
use App\Http\Actions;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@store');
    Route::get('/layered/user/{id}', 'Layered\UserController@index');
});

Route::get('users', Actions\UserIndexAction::class);
