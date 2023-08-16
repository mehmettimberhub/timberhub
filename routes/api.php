<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Timberhub\Product\UI\Http\ProductApiController;
use Timberhub\Supplier\UI\Http\SupplierApiController;

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
Route::apiResource('products', ProductApiController::class);

