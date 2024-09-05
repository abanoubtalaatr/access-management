<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('test-route-from-access-management', function(){
        return response()->json(['message' => 'Test from access management route']);
    });
});
