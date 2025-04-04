<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WageSlipController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/inv', [HomeController::class, 'list'])->name('home');
Route::get('/wageslip/create', [WageSlipController::class, 'create'])->name('wageslip.create');
Route::get('/wageslip/download-pdf/{id}', [WageSlipController::class, 'downloadPDF'])->name('wageslip.downloadPDF');
Route::get('/create', [WageSlipController::class, 'create'])->name('create'); //show form
Route::post('/store', [WageSlipController::class, 'store'])->name('store'); //add new
Route::get('/wageslip/{id}', [WageSlipController::class, 'show'])->name('wageslip-show'); //display
Route::get('/edit/{id}', [WageSlipController::class, 'edit'])->name('edit'); //edit
Route::put('/update/{id}', [WageSlipController::class, 'update'])->name('update'); //update
Route::delete('/delete/{id}', [WageSlipController::class, 'destroy'])->name('delete'); //delete
Route::get('/list/bulletin', [WageSlipController::class, 'list'])->name('list'); //list
Route::get('/employees', [HomeController::class, 'employees'])->name('employees');

//Invoice
Route::get('/create/invoice', [HomeController::class, 'create'])->name('create-invoice');
Route::post('/store/invoice', [HomeController::class, 'store'])->name('invoices.store');
Route::get('/invoices/{id}', [HomeController::class, 'show'])->name('show');
Route::get('/invoice/edit/{id}', [HomeController::class, 'edit'])->name('invoice-edit');
Route::put('/invoice/update/{id}', [HomeController::class, 'update'])->name('invoice.update');
Route::delete('/delete/invoice/{id}', [HomeController::class, 'delete'])->name('delete-invoice');
Route::get('/invoices/{id}/download', [HomeController::class, 'download'])->name('download');

// Client
Route::get('/clients', [HomeController::class, 'clients'])->name('clients');
Route::get('/create/client', [HomeController::class, 'create_client'])->name('client.create');
Route::post('/store/client', [HomeController::class, 'store_client'])->name('client.store');
Route::delete('/client/delete/{id}', [HomeController::class, 'delete_client'])->name('delete-client');
