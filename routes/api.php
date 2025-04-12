<?php

use App\Http\Controllers\TravelRequest\StoreTravelRequestController;
use Illuminate\Support\Facades\Route;

Route::post('/travel-request', StoreTravelRequestController::class)->name('travel-request.store');
