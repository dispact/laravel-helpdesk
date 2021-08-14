<?php

use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::post('/categories/new', [CategoryController::class, 'store'])
    ->name('categories.store');

Route::post('/categories/update', [CategoryController::class, 'update'])
    ->name('categories.update');
    
Route::post('/categories/delete', [CategoryController::class, 'destroy'])
    ->name('categories.destroy');

?>