<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\ClientResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesOrderResource extends JsonResource
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
            'client' => ClientResource::make($this->resource->client),
            'delivery_date' => Carbon::parse($this->resource->delivery_date)->format('Y-m-d H:i'),
            'payment_due_date' => Carbon::parse($this->resource->payment_due_date)->format('Y-m-d H:i'),
            'invoice_number' => $this->resource->invoice_number,
            'total' => $this->resource->salesOrderLines()->sum('total'),
            'quantity' => $this->resource->salesOrderLines()->sum('quantity'),
            'status' => $this->resource->status,
            'description' => $this->resource->description,
            'is_milk_sales' => $this->resource->is_milk_sales,
            'has_bacteria' => $this->client->contracts()
                ->whereHas('contractRules', function ($query) {
                    $query->where('is_bacteria', 1);
                })
                ->exists(),
            'has_fat' => $this->client->contracts()
                ->whereHas('contractRules', function ($query) {
                    $query->where('is_fat', 1);
                })
                ->exists(),
            'has_protein' => $this->client->contracts()
                ->whereHas('contractRules', function ($query) {
                    $query->where('is_protein', 1);
                })
                ->exists(),
            'contract_revenue' => $this->resource->salesOrderLines()->sum('contract_revenue'),
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
