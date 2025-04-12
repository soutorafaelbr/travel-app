<?php

use App\Http\Controllers\GetTravelRequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ShowTravelRequestController;
use App\Http\Controllers\TravelRequest\StoreTravelRequestController;
use App\Http\Controllers\UpdateStatusTravelRequestController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth:sanctum');
Route::post('/travel-request', StoreTravelRequestController::class)->name('travel-request.store')->middleware(['auth:sanctum']);
Route::patch('/travel-request/{id}', UpdateStatusTravelRequestController::class)->name('travel-request.update-status')->middleware(['auth:sanctum']);
Route::get('/travel-request/{id}', ShowTravelRequestController::class)->name('travel-request.show')->middleware(['auth:sanctum']);
Route::get('/travel-request', GetTravelRequestController::class)->name('travel-request.get')->middleware(['auth:sanctum']);
