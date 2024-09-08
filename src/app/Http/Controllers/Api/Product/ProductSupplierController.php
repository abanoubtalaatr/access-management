<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ProductSupplierRequest;
use App\Http\Resources\Api\SupplierResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductSupplierController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $suppliers = $product->suppliers();

        if ($request->has('search')) {
            $search = $request->input('search');
            $suppliers = $suppliers->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%')
                ->orWhere('address', 'like', '%'.$search.'%');
        }

        $suppliers = $suppliers->paginate();

        return SupplierResource::collection($suppliers);
    }

    public function store(Product $product, ProductSupplierRequest $request): SuccessResponse
    {
        $suppliers = $request->input('suppliers');

        foreach ($suppliers as $supplier) {
            $product->suppliers()->attach($supplier['id'], ['price' => $supplier['price']]);
        }

        return new SuccessResponse();
    }

    public function destroy(Product $product, Request $request): SuccessResponse
    {
        $product->suppliers()->detach($request->input('suppliers'));

        return new SuccessResponse();
    }
}
