<?php 

use App\Http\Controllers\BuildingController;

Route::get('/buildings', [BuildingController::class, 'index'])
    ->name('buildings.index');

Route::post('buildings/create', [BuildingController::class, 'store'])
    ->name('buildings.store');

Route::post('/buildings/update', [BuildingController::class, 'update'])
    ->name('buildings.update');

Route::post('/buildings/delete', [BuildingController::class, 'destroy'])
    ->name('buildings.destroy');

?>