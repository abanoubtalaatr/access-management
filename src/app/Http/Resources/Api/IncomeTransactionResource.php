<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomeTransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'account' => AccountResource::make($this->resource->account),
            'amount' => $this->resource->amount,
            'notes' => $this->resource->notes,
            'collect_date' => Carbon::parse($this->resource->collect_date)->format('Y-m-d H:i'),
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
