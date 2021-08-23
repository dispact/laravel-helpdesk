<?php

use App\Http\Controllers\DeviceController;

Route::get('/devices', [DeviceController::class, 'index'])
    ->name('devices.index');

Route::post('/devices/add', [DeviceController::class, 'store'])
    ->name('devices.store');

Route::post('/devices/update', [DeviceController::class, 'update'])
    ->name('devices.update');

Route::post('/devices/delete', [DeviceController::class, 'destroy'])
    ->name('devices.destroy');

?>