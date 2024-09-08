<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\Api\ProductResource;
use App\Http\Responses\Api\FailResponse;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Product::class);

        return ProductResource::collection(RequestQueryBuilder::build(Product::query(), $request)->paginate());
    }

    public function store(ProductRequest $request): ProductResource |FailResponse
    {
        $this->authorize('create', Product::class);
        // $milkProduct = Product::where('is_milk', 1)->exists();
        
        // if($milkProduct){
        //     return new FailResponse();
        // }

        $product = Product::create($request->validated());

        if ($request->has('supplier') && $request->has('supplier_price')) {
            $product->suppliers()->attach($request->input('supplier_id'), ['price' => $request->input('supplier_price')]);
        }

        return ProductResource::make($product);
    }

    public function show(Product $product): ProductResource
    {
        $this->authorize('view', $product);

        return ProductResource::make($product);
    }

    public function update(ProductRequest $request, Product $product): ProductResource
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        return ProductResource::make($product->refresh());
    }

    public function destroy(Product $product): SuccessResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return new SuccessResponse();
    }
}
