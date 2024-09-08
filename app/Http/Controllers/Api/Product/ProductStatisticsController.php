<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_products' => Product::count(),
            'number_of_product_sold' => 0, // I want to know how to calculate
            'products_sales_grow' => 0, // I want to know how to calculate ,
            'selling_products_revenue' => 0, // I want to know how to calculate
        ]);
    }
}
