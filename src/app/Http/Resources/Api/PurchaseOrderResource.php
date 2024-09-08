<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
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
            'reference_number' => $this->resource->reference_number,
            'station' => StationResource::make($this->resource->station),
            'account' => AccountResource::make($this->resource->account),
            'supplier' => SupplierResource::make($this->resource->supplier),
            'is_canceled' => $this->is_canceled == 1 ? true : false,
            'is_request' => $this->is_request == 1 ? true : false,
            'status' => $this->resource->status ?? 'not_paid',
            'description' => $this->resource->description,
            'total' => $this->resource->purchaseOrderLines()->sum('total'),
            'quantity' => $this->resource->purchaseOrderLines()->sum('quantity'),
            'date' => Carbon::parse($this->resource->date)->format('Y-m-d H:i'),
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
