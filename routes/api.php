<?php

use App\Http\Controllers\benevoleController;
use App\Http\Controllers\organizateurController;
use App\Http\Controllers\reservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

// __________________organisateur________________

Route::middleware(['auth:api', 'role:organisateur'])->group(function () {

    Route::get('get-All-annonce-organisateur',[organizateurController::class , 'redAllAnnonce']);
    Route::post('create-annonce',[organizateurController::class , 'addAnnonce']);
    Route::put('update-annonce',[organizateurController::class , 'updateAnnonce']);
    Route::delete('delete-annonce/{id}',[organizateurController::class , 'deleteAnnonce']);
    
    Route::get('get-pending-reservation',[reservationController::class , 'pendingReservation']);
    Route::put('accept-reservation/{id}',[reservationController::class , 'acceptReservation']);
    Route::put('refuse-reservation/{id}',[reservationController::class , 'refuseReservation']);
});

// ______________________bénévole____________________

Route::middleware(['auth:api', 'role:bénévole'])->group(function () {
    Route::get('get-All-annonce-benevole',[benevoleController::class , 'redAllAnnonce']);
    
    Route::post('add-reservation',[reservationController::class , 'addReservation']);
    Route::get('get-me-reservation',[reservationController::class , 'getMeReservation']);
});
Route::post('filter-by-location-type',[benevoleController::class , 'filterAnnonce']);