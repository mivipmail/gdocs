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


Route::post('/spreadsheets', App\Http\Controllers\Spreadsheet\StoreController::class);
Route::get('/spreadsheets', App\Http\Controllers\Spreadsheet\IndexController::class);


// Route::post('/user', function (Request $request) {
//     return $request->user();
// });
