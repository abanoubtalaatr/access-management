<?php

namespace App\Http\Controllers\Api\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\PurchaseOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CancelPurchaseOrderController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Request $request, PurchaseOrder $purchaseOrder): SuccessResponse
    {
        $this->authorize('update', $purchaseOrder);
        $purchaseOrder->update([
            'is_canceled' => 1,
        ]);

        return new SuccessResponse();
    }
}
