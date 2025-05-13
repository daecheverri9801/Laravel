<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\LoginController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('events', [EventController::class, 'index']);
Route::post('events', [EventController::class, 'store']);
Route::get('events/{event}', [EventController::class, 'show']);
Route::put('events/{event}', [EventController::class, 'update']);
Route::delete('events/{event}', [EventController::class, 'destroy']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', function (Request $request) {
        Route::apiResource('events', EventController::class);
        Route::apiResource('venues', VenueController::class);
    });
});

Route::post('login', [LoginController::class, 'login']);
