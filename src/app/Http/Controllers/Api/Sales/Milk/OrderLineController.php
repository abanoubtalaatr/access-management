<?php

namespace App\Http\Controllers\Api\Sales\Milk;

use App\Actions\SaleOrder\Milk\CreateOrderLine;
use App\Actions\SaleOrder\Milk\UpdateOrderLineAction;
use App\Actions\SaleOrder\RecalculateSalesOrderOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\Sales\Milk\OrderLineRequest;
use App\Http\Requests\Api\Sales\Milk\UpdateOrderLineRequest;
use App\Http\Resources\Api\SalesOrderLineResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\SalesOrderLine;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderLineController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', SalesOrderLine::class);

        return SalesOrderLineResource::collection(RequestQueryBuilder::build(SalesOrderLine::query(), $request)->paginate());
    }

    public function store(
        OrderLineRequest $request,
        CreateOrderLine $createOrderLine,
        RecalculateSalesOrderOrderAction $recalculateSalesOrderOrderAction
    ): SalesOrderLineResource {
        $this->authorize('create', SalesOrderLine::class);

        $salesOrderLine = $createOrderLine($request->validated());
        $recalculateSalesOrderOrderAction($salesOrderLine->salesOrder);

        return SalesOrderLineResource::make($salesOrderLine);
    }

    public function show(Request $request): SalesOrderLineResource
    {
        $salesOrderLine = SalesOrderLine::find($request->milk_sales_order_line);

        $this->authorize('view', $salesOrderLine);

        return SalesOrderLineResource::make($salesOrderLine);
    }

    public function update(
        UpdateOrderLineRequest $request,
        UpdateOrderLineAction $updateOrderLineAction,
        RecalculateSalesOrderOrderAction $recalculateSalesOrderOrderAction

    ): SalesOrderLineResource {
        $salesOrderLine = SalesOrderLine::find($request->milk_sales_order_line);

        $this->authorize('update', $salesOrderLine);

        $updateOrderLineAction($request->validated(), $salesOrderLine);

        $recalculateSalesOrderOrderAction($salesOrderLine->refresh()->salesOrder);

        return SalesOrderLineResource::make($salesOrderLine);
    }

    public function destroy(Request $request): SuccessResponse
    {
        $salesOrderLine = SalesOrderLine::find($request->milk_sales_order_line);

        $this->authorize('delete', $salesOrderLine);

        $salesOrderLine->delete();

        return new SuccessResponse();
    }
}
