<?php

namespace App\Http\Controllers\Api\Expense;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrderTransaction;
use Illuminate\Http\Request;

class ExpenseStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_expenses' => PurchaseOrderTransaction::sum('amount'),
            'expense_ratio' => 0, // I want to know how to calculate
            'monthly_expenses_budget' => PurchaseOrderTransaction::whereDate('created_at', now())->sum('amount'),
            'monthly_expenses_actual' => 0, // I want to know how to calculate
        ]);
    }
}
