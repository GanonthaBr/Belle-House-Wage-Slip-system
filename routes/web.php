<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WageSlipController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/wageslip/create', [WageSlipController::class, 'create'])->name('wageslip.create');
Route::get('/wageslip/download-pdf', [WageSlipController::class, 'downloadPDF'])->name('wageslip.downloadPDF');
