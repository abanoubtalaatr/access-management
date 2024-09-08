<?php

namespace App\Http\Resources\Api;

use App\Models\ProductSupplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = $request->product;
        $price = null;

        if ($product) {
            $row = ProductSupplier::where('product_id', $product->id)->where('supplier_id', $this->id)->first();
            if ($row) {
                $price = $row->price;
            }
        }

        return
        [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'price' => $price,
            'contacts' => ContactResource::collection($this->contacts),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
