<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Models\Account;
use BirdSol\AccessManagement\Models\ExpenseTransaction;
use BirdSol\AccessManagement\Models\IncomeTransaction;
use BirdSol\AccessManagement\Models\PurchaseOrderTransaction;
use BirdSol\AccessManagement\Models\SalesTransaction;
use Illuminate\Http\Request;

class CreditDebitController extends Controller
{
    public function index(Request $request, Account $account)
    {
        $accountId = $account->id;

        $query = [
            ['account_id', $accountId],
        ];

        $debit = 0;
        $credit = 0;
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
