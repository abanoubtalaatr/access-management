<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Models\Contact;
use BirdSol\AccessManagement\Models\Product;
use BirdSol\AccessManagement\Models\PurchaseOrder;
use BirdSol\AccessManagement\Models\PurchaseOrderTransaction;
use BirdSol\AccessManagement\Models\Supplier;
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
