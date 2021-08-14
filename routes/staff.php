<?php

use App\Http\Controllers\StaffController;

Route::get('/staff', [StaffController::class, 'index'])
    ->name('staff.index');

Route::post('/staff/create', [StaffController::class, 'store'])
    ->name('staff.store');

Route::post('/staff/update', [StaffController::class, 'update'])
    ->name('staff.update');

Route::post('/staff/delete', [StaffController::class, 'destroy'])
    ->name('staff.destroy');

?>