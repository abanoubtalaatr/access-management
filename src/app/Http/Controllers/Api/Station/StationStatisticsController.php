<?php

namespace App\Http\Controllers\Api\Station;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\PurchaseOrderTransaction;
use App\Models\Station;
use Illuminate\Http\Request;

class StationStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_number_of_stations' => Station::count(),
            'total_sales' => PurchaseOrderTransaction::sum('amount'), // I need to ensure from this
            'total_expenses' => Expense::count(),
        ]);
    }
}
