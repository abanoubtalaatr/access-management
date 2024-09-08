<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'status' => $this->resource->status ?? 'not_paid',
            'amount' => $this->resource->amount,
            'reference_number' => $this->resource->reference_number,
            'station' => StationResource::make($this->station),
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
