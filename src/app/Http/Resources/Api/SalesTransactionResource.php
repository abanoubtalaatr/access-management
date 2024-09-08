<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\ClientResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesTransactionResource extends JsonResource
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
            'salesOrder' => SalesOrderResource::make($this->salesOrder),
            'invoice' => $this->invoice_number,
            'account' => AccountResource::make($this->account),
            'amount' => $this->resource->amount,
            'client' => ClientResource::make($this->client),
            'notes' => $this->resource->notes,
            'collect_date' => Carbon::parse($this->collect_date)->format('Y-m-d H:i'),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
