<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'purchaseOrder' => PurchaseOrderResource::make($this->purchaseOrder),
            'account' => AccountResource::make($this->account),
            'amount' => $this->amount,
            'invoice_number' => $this->invoice_number,
            'notes' => $this->resource->notes,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i'),
            'collection_date' => $this->collection_date ? Carbon::parse($this->collection_date)->format('Y-m-d H:i') : Carbon::parse(now())->format('Y-m-d H:i'),
        ];
    }
}
