<?php

namespace App\Http\Controllers\Api\Sales;

use App\Enums\SalesOrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\SalesOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MakeSalesOrderPaidController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(SalesOrder $salesOrder)
    {
        $this->authorize('update', $salesOrder);

        $salesOrder->update(['status' => SalesOrderStatusEnum::PAID->value]);

        return new SuccessResponse();
    }
}
