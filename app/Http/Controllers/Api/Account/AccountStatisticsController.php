<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Client;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AccountStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_number_of_accounts' => Account::count(),
            'clients_account_number' => Account::where('accountable_type', Client::class)->count(),
            'suppliers_account_number' => Account::where('accountable_type', Supplier::class)->count(),
        ]);
    }
}
