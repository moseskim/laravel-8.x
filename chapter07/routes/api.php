<?php

use Illuminate\Support\Facades\Route;

Route::post(
    '/review',
    \App\Http\Controllers\Review\RegisterAction::class
);
Route::get(
    '/review',
    \App\Http\Controllers\Review\IndexAction::class
);
