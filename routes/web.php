<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpreadsheetController;


Route::get('/', [SpreadsheetController::class, 'index'])->name('spreadsheet.index');
Route::get('/create', [SpreadsheetController::class, 'create'])->name('spreadsheet.create');
Route::post('/', [SpreadsheetController::class, 'store'])->name('spreadsheet.store');

