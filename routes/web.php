<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WageSlipController;
use App\Http\Controllers\DechargeController;

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

// Employee
Route::get('/employees', [HomeController::class, 'employees'])->name('employees');
Route::get('/create/employee', [HomeController::class, 'employees_create'])->name('employees.create');
Route::post('/employees/store', [HomeController::class, 'employees_store'])->name('employees.store');
Route::delete('/employees/delete/{id}', [HomeController::class, 'employees_delete'])->name('employees.delete');


// Decharge

Route::get('/decharge', [DechargeController::class, 'decharge'])->name('decharge');
Route::post('/dechargestore', [DechargeController::class, 'dechargestore'])->name('dechargestore'); //add new
Route::get('/createdecharge', [DechargeController::class, 'createdecharge'])->name('createdecharge');
Route::get('/decharge/{id}', [DechargeController::class, 'dechargeshow'])->name('dechargeshow'); //dowload
Route::get('/editdecharge/{id}', [DechargeController::class, 'editdecharge'])->name('editdecharge'); //edit
Route::put('/updatedecharge/{id}', [DechargeController::class, 'updatedecharge'])->name('updatedecharge'); //update
Route::get('/deletedecharge/{id}', [DechargeController::class, 'deletedecharge'])->name('deletedecharge'); //remove
Route::get('/dechargepdf/{id}', [DechargeController::class, 'dechargepdf'])->name('dechargepdf'); //dowload
Route::get('/dechargesinvoices', action: [HomeController::class, 'top_10_invoices'])->name('topten');
