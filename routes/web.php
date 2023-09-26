<?php

use Illuminate\Support\Facades\Route;


Route::get('{page}', App\Http\Controllers\HomeController::class)->where('page', '.*');


// Route::get('/', function () {
//     return view('welcome');
// });
