<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Resources\Api\PermissionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PermissionResource::collection(Permission::all());
    }
}
