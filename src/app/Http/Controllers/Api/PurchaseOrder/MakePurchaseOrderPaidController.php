<?php

namespace App\Http\Controllers\Api\PurchaseOrder;

use App\Enums\PurchaseOrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\PurchaseOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MakePurchaseOrderPaidController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('update', $purchaseOrder);

        $purchaseOrder->update(['status' => PurchaseOrderStatusEnum::PAID->value]);

        return new SuccessResponse();
    }
}
