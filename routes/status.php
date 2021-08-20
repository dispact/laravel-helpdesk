<?php

use App\Http\Controllers\StatusController;

Route::get('/status', [StatusController::class, 'index'])
    ->name('status.index');

Route::post('/status/create', [StatusController::class, 'store'])
    ->name('status.store');

Route::post('/status/update', [StatusController::class, 'update'])
    ->name('status.update');

Route::post('/status/delete', [StatusController::class, 'destroy'])
    ->name('status.destroy');

?>