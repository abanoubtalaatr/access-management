<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Resources\Api\ProductResource;
use BirdSol\AccessManagement\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientProductController extends Controller
{
    public function index(Request $request, Client $client): AnonymousResourceCollection
    {
        $query = $client->products()->withPivot('price');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%'.$searchTerm.'%');
        }

        if ($request->has('is_milk')) {
            $query->where('is_milk', $request->input('is_milk'));
        }

        $products = $query->get();

        return ProductResource::collection($products);
    }
}
