<?php

use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [QrCodeController::class, 'index'])->name('qr-codes.index');

Route::get('/qr-codes/all', [QrCodeController::class, 'getAll'])->name('qr-codes.all');

Route::resource('/qr-codes', QrCodeController::class);