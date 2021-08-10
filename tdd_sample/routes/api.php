<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('customers', [ApiController::class, 'getCustomers']);
Route::post('customers', [ApiController::class, 'postCustomers']);
Route::get('customers/{customer_id}', [ApiController::class, 'getCustomer']);
Route::put('customers/{customer_id}', [ApiController::class, 'putCustomer']);
Route::delete('customers/{customer_id}', [ApiController::class, 'deleteCustomer']);
Route::get('reports', [ApiController::class, 'getReports']);
Route::post('reports', [ApiController::class, 'postReport']);
Route::get('reports/{report_id}', [ApiController::class, 'getReport']);
Route::put('reports/{report_id}', [ApiController::class, 'putReport']);
Route::delete('reports/{report_id}', [ApiController::class, 'deleteReport']);
