<?php

namespace App\Http\Controllers\Api\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PurchaseOrderResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupplierPurchaseOrderController extends Controller
{
    public function index(Request $request, Supplier $supplier): AnonymousResourceCollection
    {
        $purchaseOrders = $supplier->purchaseOrders;

        return PurchaseOrderResource::collection($purchaseOrders);
    }
}
