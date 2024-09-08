<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductClientsNotAttachedController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $clients = Client::whereDoesntHave('products', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        return ClientResource::collection($clients);
    }
}
