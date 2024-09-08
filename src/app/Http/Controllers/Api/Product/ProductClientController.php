<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ProductClientRequest;
use App\Http\Resources\ClientResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductClientController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $clients = $product->clients();

        if ($request->has('search')) {
            $search = $request->input('search');
            $clients = $clients->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%');
        }

        return ClientResource::collection($clients->paginate());
    }

    public function store(Product $product, ProductClientRequest $request): SuccessResponse
    {
        $clients = $request->input('clients');

        foreach ($clients as $client) {
            $product->clients()->attach($client['id'], ['price' => $client['price']]);
        }

        return new SuccessResponse();
    }

    public function destroy(Product $product, Request $request): SuccessResponse
    {
        $clientIds = collect($request->input('clients'))->pluck('id');

        // Detach the clients using their IDs
        $product->clients()->detach($clientIds);

        return new SuccessResponse();
    }
}
