<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SalesOrderResource;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProductSalesOrderController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request, Product $product)
    {
        $this->authorize('view', $product);

        $salesOrders = $product->salesOrders()->paginate();

        return SalesOrderResource::collection($salesOrders);
    }
}
