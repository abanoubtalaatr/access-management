<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return UserResource::make($request->user());
    }
}
