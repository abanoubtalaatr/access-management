<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Controllers\Controller;
use App\Models\ExpenseTransaction;
use App\Models\IncomeTransaction;
use App\Models\PurchaseOrderTransaction;
use App\Models\SalesTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CreditDebitController extends Controller
{
    public function index(Request $request, Supplier $supplier)
    {
        if (! $supplier->account) {
            return response()->json([
                'message' => 'Supplier does not have an associated account.',
                'credit' => 0,
                'debit' => 0,
            ], 400);
        }
        $accountId = $supplier->account->id;
        $debit = 0;
        $credit = 0;

        $query = [
            ['account_id', $accountId],
        ];

        if ($request->filled('startAt')) {
            $query[] = ['created_at', '>=', $request->input('startAt')];
        }

        if ($request->filled('endAt')) {
            $query[] = ['created_at', '<=', $request->input('endAt')];
        }

        $purchaseTransactions = PurchaseOrderTransaction::where($query)->get();
        $expenseTransactions = ExpenseTransaction::where($query)->get();

        $debit += $purchaseTransactions->sum('amount');
        $debit += $expenseTransactions->sum('amount');

        $salesTransactions = SalesTransaction::where($query)->get();
        $incomeTransactions = IncomeTransaction::where($query)->get();

        $credit += $salesTransactions->sum('amount');
        $credit += $incomeTransactions->sum('amount');

        return response()->json([
            'credit' => $credit,
            'debit' => $debit,
        ]);
    }
}
