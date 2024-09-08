<?php

namespace BirdSol\AccessManagement\App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\App\Http\Resources\Api\PermissionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PermissionResource::collection(Permission::all());
    }
}
