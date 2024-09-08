<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\ContactResource;
use App\Models\ClientProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            $row = ClientProduct::where('product_id', $product->id)->where('client_id', $this->id)->first();
            if ($row) {
                $price = $row->price;
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'price' => $price,
            'contacts' => ContactResource::collection($this->whenLoaded('contacts')),
        ];
    }
}
