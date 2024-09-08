<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MilkWeightResource extends JsonResource
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
            'station' => StationResource::make($this->station),
            'salesOrder' => SalesOrderResource::make($this->resource->salesOrder),
            'weight' => $this->resource->weight,
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
