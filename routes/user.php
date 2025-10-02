<?php

use App\Http\Controllers\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // User tickets
    Route::get('/my-tickets', [UserTicketController::class, 'index'])->name('user.tickets.index');
    Route::get('/my-tickets/{ticket}', [UserTicketController::class, 'show'])->name('user.tickets.show');
    
    // Add more user-related routes here in the future
});
