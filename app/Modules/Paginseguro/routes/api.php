<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/payments/paginseguro')
    ->middleware('api')
    ->namespace('App\\Modules\\Paginseguro')->group(function () {
        Route::post('/{token}', 'Controller@updateStatus')->name('paginseguro.status-hook');
    });
