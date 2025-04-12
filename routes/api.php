<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\TravelRequest\GetTravelRequestController;
use App\Http\Controllers\TravelRequest\ShowTravelRequestController;
use App\Http\Controllers\TravelRequest\StoreTravelRequestController;
use App\Http\Controllers\TravelRequest\UpdateStatusTravelRequestController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');

Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth:sanctum');

Route::post('/travel-request', StoreTravelRequestController::class)->name('travel-request.store')->middleware(['auth:sanctum']);

Route::patch('/travel-request/{travelRequest}', UpdateStatusTravelRequestController::class)
    ->name('travel-request.update-status')
    ->middleware(['auth:sanctum', 'can:update,travelRequest']);

Route::get('/travel-request/{travelRequest}', ShowTravelRequestController::class)
    ->name('travel-request.show')
    ->middleware(['auth:sanctum', 'can:view,travelRequest']);

Route::get('/travel-request', GetTravelRequestController::class)
    ->name('travel-request.get')
    ->middleware(['auth:sanctum']);
