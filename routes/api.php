<?php

use App\Http\Controllers\ShowTravelRequestController;
use App\Http\Controllers\TravelRequest\StoreTravelRequestController;
use App\Http\Controllers\UpdateStatusTravelRequestController;
use Illuminate\Support\Facades\Route;

Route::post('/travel-request', StoreTravelRequestController::class)->name('travel-request.store');
Route::patch('/travel-request/{id}', UpdateStatusTravelRequestController::class)
    ->name('travel-request.update-status');
Route::get('/travel-request/{id}', ShowTravelRequestController::class)
    ->name('travel-request.show');
