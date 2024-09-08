<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Models\Account;
use BirdSol\AccessManagement\Models\Client;
use BirdSol\AccessManagement\Models\Supplier;
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
