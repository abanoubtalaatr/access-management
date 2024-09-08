<?php

namespace App\Http\Resources\Sales\Milk;

use App\Http\Resources\Api\StationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StationSalesOrderLinesResource extends JsonResource
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
            'station' => StationResource::make($this->resource->station),
            'weight' => $this->resource->weight,
        ];
    }
}
