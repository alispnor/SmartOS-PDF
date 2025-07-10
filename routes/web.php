<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceOrderController;
use App\Models\ServiceOrder; // Importe o modelo ServiceOrder

Route::get('/', function () {
    return view('welcome');
});

Route::get('/os/{serviceOrder}/pdf', [ServiceOrderController::class, 'generatePdf'])->name('service_orders.generate_pdf');
Route::get('/os-test/pdf/{id}', [ServiceOrderController::class, 'generatePdfTest'])->name('service_orders.generate_pdf_test');


Route::get('/test-laravel', function () {
    return 'Laravel is working!';
});