<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupplierProductController extends Controller
{
    public function index(Request $request, Supplier $supplier): AnonymousResourceCollection
    {
        $query = $supplier->products();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%'.$searchTerm.'%');
        }

        $products = $query->get();

        return ProductResource::collection($products);
    }
}
