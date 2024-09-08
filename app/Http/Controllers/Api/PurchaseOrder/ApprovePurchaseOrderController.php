<?php

namespace App\Http\Controllers\Api\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\PurchaseOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApprovePurchaseOrderController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(PurchaseOrder $purchaseOrder): SuccessResponse
    {
        $this->authorize('update', $purchaseOrder);

        $purchaseOrder->update(['is_request' => 0]);

        return new SuccessResponse();
    }
}
