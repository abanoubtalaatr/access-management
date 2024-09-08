<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderTransaction;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class SupplierStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_sales_orders' => SalesOrder::count(),
            'total_purchase_orders' => PurchaseOrder::count(),
            'total_transactions' => PurchaseOrderTransaction::count(),
            'total_products' => Product::count(),
        ]);
    }
}
