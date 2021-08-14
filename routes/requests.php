<?php

use App\Http\Controllers\RequestController;

Route::get('/requests', [RequestController::class, 'index'])
    ->middleware('auth')
    ->name('requests.index');

Route::get('/create-request', [RequestController::class, 'create'])
    ->middleware('auth')
    ->name('requests.create');

Route::post('/create-request', [RequestController::class, 'store'])
    ->middleware('auth')
    ->name('requests.store');

Route::get('/requests/{ticket:id}', [RequestController::class, 'show'])
    ->middleware('auth')
    ->name('requests.show');

?>