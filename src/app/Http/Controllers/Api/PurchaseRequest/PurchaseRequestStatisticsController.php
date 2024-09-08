<?php

namespace App\Http\Controllers\Api\PurchaseRequest;

use App\Enums\PurchaseRequestStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class PurchaseRequestStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_requests' => PurchaseRequest::count(),
            'pending_requests' => PurchaseRequest::where('status', PurchaseRequestStatusEnum::PENDING)->count(),
            'approved_requests' => PurchaseRequest::where('status', PurchaseRequestStatusEnum::APPROVED)->count(),
            'cancelled_requests' => PurchaseRequest::where('status', PurchaseRequestStatusEnum::CANCELLED)->count(),
        ]);
    }
}
