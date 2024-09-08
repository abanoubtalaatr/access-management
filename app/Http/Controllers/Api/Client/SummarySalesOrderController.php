<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Models\SalesOrder;
use Illuminate\Http\Request;

class SummarySalesOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = SalesOrder::where('client_id', $request->client);

        if ($request->filled('startAt')) {
            $query->where('created_at', '>=', $request->input('startAt'));
        }

        if ($request->filled('endAt')) {
            $query->where('created_at', '<=', $request->input('endAt'));
        }

        $summary = $query->sum('total');

        return response()->json([
            'summary' => $summary,
        ]);
    }
}
