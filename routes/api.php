<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;

Route::middleware(['auth:sanctum'])->get('/user', [ProfileController::class, 'show']);

Route::middleware('auth:api')->group(function () {
    Route::post('accept-invitation', [\BirdSol\AccessManagement\Http\Controllers\Api\Invitation\AcceptInvitationController::class, 'store'])->name('api.accept-invitation.store');

});
