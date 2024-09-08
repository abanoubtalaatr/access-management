<?php

namespace App\Http\Controllers\Api\PurchaseOrder;

use App\Actions\CreatePurchaseOrderLineAction;
use App\Actions\PurchaseOrder\UpdatePurchaseOrderLinePriceAction;
use App\Actions\RecalculatePurchaseOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\PurchaseRequestLine\PurchaseOrderLineRequest;
use App\Http\Resources\Api\PurchaseOrderLine\PurchaseOrderLineResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\PurchaseOrderLine;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PurchaseOrderLineController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', PurchaseOrderLine::class);

        return PurchaseOrderLineResource::collection(RequestQueryBuilder::build(PurchaseOrderLine::query(), $request)->paginate());
    }

    public function store(
        PurchaseOrderLineRequest $request,
        CreatePurchaseOrderLineAction $createPurchaseOrderLineAction,
        RecalculatePurchaseOrderAction $recalculatePurchaseOrderAction
    ): PurchaseOrderLineResource {
        $this->authorize('create', PurchaseOrderLine::class);

        $purchaseOrderLine = $createPurchaseOrderLineAction($request->validated());

        ($recalculatePurchaseOrderAction)($purchaseOrderLine->purchaseOrder);

        return PurchaseOrderLineResource::make($purchaseOrderLine);
    }

    public function show(PurchaseOrderLine $purchaseOrderLine): PurchaseOrderLineResource
    {
        $this->authorize('view', $purchaseOrderLine);

        return PurchaseOrderLineResource::make($purchaseOrderLine);
    }

    public function update(
        PurchaseOrderLineRequest $request,
        PurchaseOrderLine $purchaseOrderLine,
        UpdatePurchaseOrderLinePriceAction $updatePurchaseOrderLinePriceAction,
        RecalculatePurchaseOrderAction $recalculatePurchaseOrderAction
    ): PurchaseOrderLineResource {
        $this->authorize('update', $purchaseOrderLine);

        $purchaseOrderLine->update($request->validated());

        $updatePurchaseOrderLinePriceAction($request->validated(), $purchaseOrderLine->refresh());

        ($recalculatePurchaseOrderAction)($purchaseOrderLine->refresh()->purchaseOrder);

        return PurchaseOrderLineResource::make($purchaseOrderLine);
    }

    public function destroy(PurchaseOrderLine $purchaseOrderLine): SuccessResponse
    {
        $this->authorize('delete', $purchaseOrderLine);

        $purchaseOrderLine->delete();

        return new SuccessResponse();
    }
}
