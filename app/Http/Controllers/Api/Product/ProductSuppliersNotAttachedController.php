<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SupplierResource;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductSuppliersNotAttachedController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $suppliers = Supplier::whereDoesntHave('products', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        return SupplierResource::collection($suppliers);
    }
}
