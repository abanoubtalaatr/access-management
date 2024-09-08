<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->resource->name,
            'category' => CategoryResource::make($this->resource->category),
            'unit' => UnitResource::make($this->resource->unit),
            'is_sellable' => $this->resource->is_sellable,
            'is_purchasable' => $this->resource->is_purchasable,
            'purchasing_price' => $this->resource->purchasing_price,
            'selling_price' => $this->resource->selling_price,
            'tax' => $this->resource->tax,
            'is_milk' => $this->resource->is_milk,
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
            'client_price' => $this->resource->pivot?->price,
        ];
    }
}
