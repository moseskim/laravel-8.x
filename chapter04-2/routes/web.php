<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', Controllers\IndexAction::class);
Route::get('article', Controllers\ArticlePayloadAction::class);
Route::get('text', Controllers\TextAction::class);
Route::get('view', Controllers\ViewAction::class);
Route::get('download', Controllers\DownloadAction::class);
Route::get('json', Controllers\JsonAction::class);
Route::get('jsonp', Controllers\JsonpAction::class);
Route::get('media', Controllers\MediaAction::class);
Route::get('stream', Controllers\StreamAction::class);
