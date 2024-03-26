<?php

use App\Http\Controllers\organizateurController;
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

    Route::get('get-All-annonce',[organizateurController::class , 'redAllAnnonce']);
    Route::post('create-annonce',[organizateurController::class , 'addAnnonce']);
    Route::put('update-annonce',[organizateurController::class , 'updateAnnonce']);
    Route::delete('delete-annonce/{id}',[organizateurController::class , 'deleteAnnonce']);
});