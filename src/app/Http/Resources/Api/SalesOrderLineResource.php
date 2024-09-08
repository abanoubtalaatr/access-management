<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Sales\Milk\StationSalesOrderLinesResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesOrderLineResource extends JsonResource
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
            'quantity' => $this->resource->quantity,
            'product' => ProductResource::make($this->resource->product),
            'stationSalesOrderLines' => StationSalesOrderLinesResource::collection($this->resource->salesOrderStations),
            'price' => $this->resource->price,
            'total' => $this->resource->total + $this->contract_revenue,
            'taxes' => $this->resource->taxes,
            'contract_revenue' => $this->contract_revenue,
            'total_farm_weight' => $this->resource->total_farm_weight,
            'total_client_weight' => $this->resource->total_client_weight,
            'protein_percentage' => $this->resource->protein_percentage,
            'bacteria_number' => $this->resource->bacteria_number,
            'fat_percentage' => $this->resource->fat_percentage,
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
