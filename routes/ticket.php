<?php

use App\Http\Middleware\StaffOnly;
use App\Http\Controllers\TicketController;

Route::get('/tickets', [TicketController::class, 'index'])
    ->name('tickets.index');

Route::get('/ticket/{ticket:id}', [TicketController::class, 'show'])
    ->name('tickets.show');

Route::post('/ticket', [TicketController::class, 'store'])
    ->name('tickets.store');

Route::post('/update/ticket', [TicketController::class, 'update'])
    ->name('tickets.update');

Route::post('/update/ticket/staff', [TicketController::class, 'updateStaff'])
    ->name('tickets.update.staff');

?>