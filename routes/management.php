<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'manage'], function() {

   Route::get('/buildings', function() {
       return view('buildings.index');
   })->name('buildings.index');

   Route::get('/statuses', function() {
       return view('status.index');
   })->name('status.index');

   Route::get('/categories', function() {
       return view('categories.index');
   })->name('categories.index');

   Route::get('/staff', function() {
       return view('staff.index');
   })->name('staff.index');

   Route::get('/users', function() {
       return view('users.index');
   })->name('users.index');

   Route::get('/models', function() {
       return view('device-models.index');
   })->name('device-models.index');

   Route::get('/devices', function() {
       return view('devices.index');
   })->name('devices.index');

});

?>