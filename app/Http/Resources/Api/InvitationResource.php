<?php

namespace BirdSol\AccessManagement\Http\Resources\Api;

use BirdSol\AccessManagement\Http\Resources\Api\Role\SimpleRoleResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'role' => SimpleRoleResource::make($this->resource->role),
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'invitation_token' => $this->resource->invitation_token,
            'created_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
