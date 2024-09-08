<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseRequestResource extends JsonResource
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
            'status' => $this->resource->status,
            'account' => AccountResource::make($this->resource->account),
            'station' => StationResource::make($this->station),
            'product' => ProductResource::make($this->resource->product),
            'total' => $this->resource->total,
            'supplier' => SupplierResource::make($this->resource->supplier),
            'quantity' => $this->resource->quantity,
            'justification' => $this->resource->justification,
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];

    }
}
