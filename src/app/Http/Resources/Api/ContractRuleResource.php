<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractRuleResource extends JsonResource
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
            'contract' => ContractResource::make($this->resource->contract),
            'number_or_percentage' => $this->resource->number_or_percentage,
            'fee_per_liter' => $this->resource->fee_per_liter,
            'is_protein' => $this->resource->is_protein,
            'is_bacteria' => $this->resource->is_bacteria,
            'is_fat' => $this->resource->is_fat,
        ];
    }
}
