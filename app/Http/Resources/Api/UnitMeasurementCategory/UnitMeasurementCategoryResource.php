<?php

namespace App\Http\Resources\Api\UnitMeasurementCategory;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitMeasurementCategoryResource extends JsonResource
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
            'is_weight' => $this->resource->is_weight,
            'is_volume' => $this->resource->is_volume,
            'is_unit' => $this->resource->is_unit,
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
