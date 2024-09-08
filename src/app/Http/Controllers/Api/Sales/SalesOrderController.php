<?php

namespace App\Http\Controllers\Api\Sales;

use App\Actions\CreateInvoiceAction;
use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\SalesOrderRequest;
use App\Http\Resources\Api\SalesOrderResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\SalesOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SalesOrderController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', SalesOrder::class);

        return SalesOrderResource::collection(RequestQueryBuilder::build(SalesOrder::query(), $request)->paginate());
    }

    public function store(
        SalesOrderRequest $request,
        CreateInvoiceAction $createInvoiceAction
    ): SalesOrderResource {
        $this->authorize('create', SalesOrder::class);

        $salesOrder = SalesOrder::create($request->validated());

        return SalesOrderResource::make($salesOrder->refresh());
    }

    public function show(SalesOrder $salesOrder): SalesOrderResource
    {
        $this->authorize('view', $salesOrder);

        return SalesOrderResource::make($salesOrder);
    }

    public function update(SalesOrderRequest $request, SalesOrder $salesOrder): SalesOrderResource
    {
        $this->authorize('update', $salesOrder);

        $salesOrder->update($request->validated());

        return SalesOrderResource::make($salesOrder->refresh());
    }

    public function destroy(SalesOrder $salesOrder): SuccessResponse
    {
        $this->authorize('delete', $salesOrder);

        $salesOrder->delete();

        return new SuccessResponse();
    }
}
