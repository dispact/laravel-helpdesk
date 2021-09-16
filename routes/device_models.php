<?php

use App\Http\Controllers\DeviceModelController;

Route::get('/device-models', [DeviceModelController::class, 'index'])
    ->name('device_models.index');

?>