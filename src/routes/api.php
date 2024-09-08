<?php

use Illuminate\Support\Facades\Route;

Route::post('accept-invitation', [\BirdSol\AccessManagement\App\Http\Controllers\Api\Invitation\AcceptInvitationController::class, 'store'])->name('api.accept-invitation.store');

Route::middleware(['auth:sanctum'])->get('/user', [\BirdSol\AccessManagement\App\Http\Controllers\Api\ProfileController::class, 'show']);

/*
|--------------------------------------------------------------------------
|  Permissions...
|--------------------------------------------------------------------------
*/


Route::get('permissions', [\BirdSol\AccessManagement\App\Http\Controllers\Api\Permission\PermissionController::class, 'index']);
Route::apiResource('users', \BirdSol\AccessManagement\App\Http\Controllers\Api\User\UserController::class);


Route::middleware(['auth:sanctum'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    |  Profile...
    |--------------------------------------------------------------------------
     */

    Route::get('profile', [\BirdSol\AccessManagement\App\Http\Controllers\Api\ProfileController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    |  Permissions...
    |--------------------------------------------------------------------------
     */

    Route::get('permissions', [\BirdSol\AccessManagement\App\Http\Controllers\Api\Permission\PermissionController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    |  Users...
    |--------------------------------------------------------------------------
     */
    Route::apiResource('users', \BirdSol\AccessManagement\App\Http\Controllers\Api\User\UserController::class);

    /*
    |--------------------------------------------------------------------------
    |  Roles...
    |--------------------------------------------------------------------------
     */

    Route::apiResource('roles', \BirdSol\AccessManagement\App\Http\Controllers\Api\Role\RoleController::class);
    Route::post('users/{user}/roles', [\BirdSol\AccessManagement\App\Http\Controllers\Api\User\UserRoleController::class, 'store'])->name('assign.role');
    Route::delete('users/{user}/roles', [\BirdSol\AccessManagement\App\Http\Controllers\Api\User\UserRoleController::class, 'destroy'])->name('remove.role');

    /*
    |--------------------------------------------------------------------------
    |  Invitations...
    |--------------------------------------------------------------------------
     */

    Route::apiResource('invitations', \BirdSol\AccessManagement\App\Http\Controllers\Api\Invitation\InvitationController::class);
    Route::get('accept-invitation/{invitation:invitation_token}', [\BirdSol\AccessManagement\App\Http\Controllers\Api\Invitation\AcceptInvitationController::class, 'show'])->name('api.accept-invitation.show');
    Route::post('invitations/{invitation}/resend', \BirdSol\AccessManagement\App\Http\Controllers\Api\Invitation\ResendInvitationController::class)->middleware('throttle:10,1')->name('api.invitations.resend');
});

require __DIR__.'/auth.php';