<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'client' => ClientResource::make($this->resource->client),
            'start_date' => $this->resource->start_date,
            'end_date' => $this->resource->end_date,
            'price' => $this->resource->price,
            'delivery_fees' => $this->resource->delivery_fees,
        ];
    }
}
