<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PurchaseOrderTransactionResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupplierTransactionController extends Controller
{
    public function index(Request $request, Supplier $supplier): AnonymousResourceCollection
    {
        $query = $supplier->purchaseOrderTransactions();

        // Apply date range filter
        if ($request->has(['startAt', 'endAt'])) {
            $startAt = $request->query('startAt');
            $endAt = $request->query('endAt');

            // Assuming 'created_at' belongs to 'purchase_order_transactions'
            $query->whereBetween('purchase_order_transactions.created_at', [$startAt, $endAt]);
        }

        $transactions = $query->paginate();

        return PurchaseOrderTransactionResource::collection($transactions);
    }
}
