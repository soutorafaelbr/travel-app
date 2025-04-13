<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\TravelOrder\GetTravelOrderController;
use App\Http\Controllers\TravelOrder\ShowTravelOrderController;
use App\Http\Controllers\TravelOrder\StoreTravelOrderController;
use App\Http\Controllers\TravelOrder\UpdateStatusTravelOrderController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');

Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth:sanctum');

Route::post('/travel-order', StoreTravelOrderController::class)->name('travel-order.store')->middleware(['auth:sanctum']);

Route::patch('/travel-order/{travelOrder}', UpdateStatusTravelOrderController::class)
    ->name('travel-order.update-status')
    ->middleware(['auth:sanctum', 'can:update,travelOrder']);

Route::get('/travel-order/{travelOrder}', ShowTravelOrderController::class)
    ->name('travel-order.show')
    ->middleware(['auth:sanctum', 'can:view,travelOrder']);

Route::get('/travel-order', GetTravelOrderController::class)
    ->name('travel-order.get')
    ->middleware(['auth:sanctum']);
