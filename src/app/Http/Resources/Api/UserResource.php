<?php

namespace BirdSol\AccessManagement\Http\Resources\Api;

use Illuminate\Http\Request;
use BirdSol\AccessManagement\Http\Resources\Api\PermissionResource;
use Illuminate\Http\Resources\Json\JsonResource;
use BirdSol\AccessManagement\Http\Resources\Api\Role\SimpleRoleResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => SimpleRoleResource::make($this->roles()->first()),
            'permissions' => $this->roles()->first() ? PermissionResource::collection($this->roles()->first()->permissions) : [],
        ];
    }
}
