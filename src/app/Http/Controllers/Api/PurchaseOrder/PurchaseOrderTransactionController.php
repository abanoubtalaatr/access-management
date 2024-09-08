<?php

namespace App\Http\Controllers\Api\PurchaseOrder;

use App\Actions\PurchaseOrderCheckPaymentStatusAction;
use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\PurchaseOrderTransactionRequest;
use App\Http\Resources\Api\PurchaseOrderTransactionResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\PurchaseOrderTransaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PurchaseOrderTransactionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', PurchaseOrderTransaction::class);

        return PurchaseOrderTransactionResource::collection(RequestQueryBuilder::build(PurchaseOrderTransaction::query(), $request)->paginate());
    }

    public function store(
        PurchaseOrderTransactionRequest $request,
        PurchaseOrderCheckPaymentStatusAction $purchaseOrderCheckPaymentStatusAction
    ): PurchaseOrderTransactionResource {
        $this->authorize('create', PurchaseOrderTransaction::class);

        $purchase_order_transaction = PurchaseOrderTransaction::create($request->validated());

        $purchaseOrderCheckPaymentStatusAction($purchase_order_transaction->purchaseOrder);

        return PurchaseOrderTransactionResource::make($purchase_order_transaction);
    }

    public function show(PurchaseOrderTransaction $purchase_order_transaction): PurchaseOrderTransactionResource
    {
        $this->authorize('view', $purchase_order_transaction);

        return PurchaseOrderTransactionResource::make($purchase_order_transaction);
    }

    public function update(
        PurchaseOrderTransactionRequest $request,
        PurchaseOrderTransaction $purchaseOrderTransaction,
        PurchaseOrderCheckPaymentStatusAction $purchaseOrderCheckPaymentStatusAction
    ): PurchaseOrderTransactionResource {
        $this->authorize('update', $purchaseOrderTransaction);

        $purchaseOrderTransaction->update($request->validated());
        $purchaseOrderCheckPaymentStatusAction($purchaseOrderTransaction->refresh()->purchaseOrder);

        return PurchaseOrderTransactionResource::make($purchaseOrderTransaction->refresh());
    }

    public function destroy(
        PurchaseOrderTransaction $purchase_order_transaction,
        PurchaseOrderCheckPaymentStatusAction $purchaseOrderCheckPaymentStatusAction
    ): SuccessResponse {

        $this->authorize('delete', $purchase_order_transaction);

        $purchaseOrderCheckPaymentStatusAction($purchase_order_transaction->purchaseOrder);

        $purchase_order_transaction->delete();

        return new SuccessResponse();
    }
}
