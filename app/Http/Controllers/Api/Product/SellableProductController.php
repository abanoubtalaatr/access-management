<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SellableProductController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Product $product): SuccessResponse
    {
        $this->authorize('update', $product);

        $product->update([
            'is_sellable' => ! $product->is_sellable,
        ]);

        return new SuccessResponse();
    }
}
