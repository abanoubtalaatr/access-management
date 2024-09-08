<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_clients' => Client::count(),
            'client_retention_rate' => 0, // exist like a filter i want to know how to calculate
            'top_revenue_clients' => 0, // exist like a filter i want to know how to calculate
        ]);
    }
}
