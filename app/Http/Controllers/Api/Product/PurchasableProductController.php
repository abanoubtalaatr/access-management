<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PurchasableProductController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Product $product): SuccessResponse
    {
        $this->authorize('update', $product);

        $product->update([
            'is_purchasable' => ! $product->is_purchasable,
        ]);

        return new SuccessResponse();
    }
}
