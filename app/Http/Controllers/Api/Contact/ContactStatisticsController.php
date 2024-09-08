<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ContactStatisticsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'total_suppliers' => Contact::where('contactable_type', Supplier::class)->count(),
            'total_purchase_orders' => PurchaseOrder::count(),
            'total_transactions' => PurchaseOrderTransaction::count(),
            'total_products' => Product::count(),
        ]);
    }
}
