<?php

namespace App\Http\Controllers\Api\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_orders' => PurchaseOrder::count(),
            'orders_closed' => 0, // I want to know how to calculate
            'orders_opened' => 0, // I want to know how to calculate
            'average_fulfillment_time' => 0, // I want to know how to calculate
        ]);
    }
}
