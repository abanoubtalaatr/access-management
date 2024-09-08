<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Client\SimpleClientResource;
use App\Http\Resources\Api\Supplier\SimpleSupplierResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Determine the accountable resource
        $accountable = null;
        switch ($this->resource->accountable_type) {
            case 'App\Models\Station':
                $accountable = new SimpleStationResource($this->resource->accountable);
                break;
            case 'App\Models\Client':
                $accountable = new SimpleClientResource($this->resource->accountable);
                break;
            case 'App\Models\Supplier':
                $accountable = new SimpleSupplierResource($this->resource->accountable);
                break;
        }

        return [
            'id' => $this->id,
            'name' => $this->resource->name,
            'accountable_id' => $this->resource->accountable_id,
            'accountable_type' => $this->resource->accountable_type,
            'accountable' => $accountable,
            'is_global' => $this->resource->is_global,
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
