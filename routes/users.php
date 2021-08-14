<?php

use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::post('/users/create', [UserController::class, 'store'])
    ->name('users.store');

Route::post('/users/update', [UserController::class, 'update'])
    ->name('users.update');

Route::post('/users/delete', [UserController::class, 'destroy'])
    ->name('users.destroy');

?>