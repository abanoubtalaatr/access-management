<?php

namespace App\Http\Resources\Api\PurchaseOrderLine;

use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\PurchaseOrderResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderLineResource extends JsonResource
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
            'purchaseOrder' => PurchaseOrderResource::make($this->resource->purchaseOrder),
            'product' => ProductResource::make($this->resource->product),
            'quantity' => $this->resource->quantity,
            'price' => $this->resource->price,
            'tax' => $this->resource->tax,
            'total' => $this->resource->total,
            'sub_total' => $this->resource->sub_total,
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d'),
        ];
    }
}
