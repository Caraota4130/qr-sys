<?php

use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QrCodeController::class, 'index'])->name('index');

Route::resource('qr-codes', QrCodeController::class);