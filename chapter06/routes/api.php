<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/users', \App\Http\Controllers\UserAction::class)->middleware('auth:api');

Route::post('/users/login', \App\Http\Controllers\User\LoginAction::class);
Route::post('/users/', \App\Http\Controllers\User\RetrieveAction::class)->middleware('auth:jwt');
