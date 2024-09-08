<?php

use Illuminate\Support\Facades\Route;

Route::post('accept-invitation', [\BirdSol\AccessManagement\Http\Controllers\Api\Invitation\AcceptInvitationController::class, 'store'])->name('api.accept-invitation.store');

Route::middleware(['auth:sanctum'])->get('/user', [\BirdSol\AccessManagement\Http\Controllers\Api\ProfileController::class, 'show']);
Route::post('accept-invitation', [\BirdSol\AccessManagement\Http\Controllers\Api\Invitation\AcceptInvitationController::class, 'store'])->name('api.accept-invitation.store');

/*
|--------------------------------------------------------------------------
|  Permissions...
|--------------------------------------------------------------------------
*/

Route::get('permissions', [\BirdSol\AccessManagement\Http\Controllers\Api\Permission\PermissionController::class, 'index']);
Route::apiResource('users', \BirdSol\AccessManagement\Http\Controllers\Api\User\UserController::class);


Route::apiResource('roles', \BirdSol\AccessManagement\Http\Controllers\Api\Role\RoleController::class);
Route::post('users/{user}/roles', [\BirdSol\AccessManagement\Http\Controllers\Api\User\UserRoleController::class, 'store'])->name('assign.role');
Route::delete('users/{user}/roles', [\BirdSol\AccessManagement\Http\Controllers\Api\User\UserRoleController::class, 'destroy'])->name('remove.role');


Route::apiResource('invitations', \BirdSol\AccessManagement\Http\Controllers\Api\Invitation\InvitationController::class);
Route::get('accept-invitation/{invitation:invitation_token}', [\BirdSol\AccessManagement\Http\Controllers\Api\Invitation\AcceptInvitationController::class, 'show'])->name('api.accept-invitation.show');
Route::post('invitations/{invitation}/resend', \BirdSol\AccessManagement\Http\Controllers\Api\Invitation\ResendInvitationController::class)->middleware('throttle:10,1')->name('api.invitations.resend');
