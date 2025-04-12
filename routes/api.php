<?php

use App\Http\Controllers\GetTravelRequestController;
use App\Http\Controllers\ShowTravelRequestController;
use App\Http\Controllers\TravelRequest\StoreTravelRequestController;
use App\Http\Controllers\UpdateStatusTravelRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/travel-request', StoreTravelRequestController::class)->name('travel-request.store');
    Route::patch('/travel-request/{id}', UpdateStatusTravelRequestController::class)->name('travel-request.update-status');
    Route::get('/travel-request/{id}', ShowTravelRequestController::class)->name('travel-request.show');
    Route::get('/travel-request', GetTravelRequestController::class)->name('travel-request.get');
});
