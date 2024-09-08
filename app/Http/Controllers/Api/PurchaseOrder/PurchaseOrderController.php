<?php

namespace App\Http\Controllers\Api\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\PurchaseOrder\PurchaseOrderRequest;
use App\Http\Resources\Api\PurchaseOrderResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\PurchaseOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PurchaseOrderController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', PurchaseOrder::class);

        return PurchaseOrderResource::collection(RequestQueryBuilder::build(PurchaseOrder::query(), $request)->paginate());
    }

    public function store(PurchaseOrderRequest $request): PurchaseOrderResource
    {
        $this->authorize('create', PurchaseOrder::class);

        $purchaseOrder = PurchaseOrder::create($request->validated());

        return PurchaseOrderResource::make($purchaseOrder->refresh());
    }

    public function show(PurchaseOrder $purchaseOrder): PurchaseOrderResource
    {
        $this->authorize('view', $purchaseOrder);

        return PurchaseOrderResource::make($purchaseOrder);
    }

    public function update(PurchaseOrderRequest $request, PurchaseOrder $purchaseOrder): PurchaseOrderResource
    {
        $this->authorize('update', $purchaseOrder);

        $purchaseOrder->update($request->validated());

        return PurchaseOrderResource::make($purchaseOrder);
    }

    public function destroy(PurchaseOrder $purchaseOrder): SuccessResponse
    {
        $this->authorize('delete', $purchaseOrder);

        $purchaseOrder->delete();

        return new SuccessResponse();
    }
}
