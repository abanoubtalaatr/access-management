<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Client\SimpleClientResource;
use App\Http\Resources\Api\Supplier\SimpleSupplierResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $contactable = null;

        switch ($this->resource->contactable_type) {
            case 'App\Models\Station':
                $contactable = new SimpleStationResource($this->resource->contactable);
                break;
            case 'App\Models\Client':
                $contactable = new SimpleClientResource($this->resource->contactable);
                break;
            case 'App\Models\Supplier':
                $contactable = new SimpleSupplierResource($this->resource->contactable);
                break;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'contactable' => $contactable,
            'contactable_type' => $this->contactable_type,
            'contactable_id' => $this->contactable_id,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
