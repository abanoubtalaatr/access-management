<?php

namespace App\Http\Controllers\Api\Sales;

use App\Http\Controllers\Controller;
use App\Models\SalesOrderLine;

class StatisticSalesController extends Controller
{
    public function index()
    {
        $totalRevenue = SalesOrderLine::sum('total');

        $totalSales = SalesOrderLine::sum('price');

        return response()->json([
            'total_revenue' => $totalRevenue,
            'total_sales' => $totalSales,
            'number_of_sold_products' => 0,
            'fat_bacterial_count_bonuses' => 0,
        ]);
    }
}
