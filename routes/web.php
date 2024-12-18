<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WageSlipController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/wageslip/create', [WageSlipController::class, 'create'])->name('wageslip.create');
Route::get('/wageslip/download-pdf', [WageSlipController::class, 'downloadPDF'])->name('wageslip.downloadPDF');
Route::get('/create', [WageSlipController::class, 'create'])->name('create'); //show form
Route::post('/store', [WageSlipController::class, 'store'])->name('store'); //add new
Route::get('/wageslip/{id}', [WageSlipController::class, 'show'])->name('show'); //display
Route::get('/edit/{id}', [WageSlipController::class, 'edit'])->name('edit'); //edit
Route::put('/update/{id}', [WageSlipController::class, 'update'])->name('update'); //update
