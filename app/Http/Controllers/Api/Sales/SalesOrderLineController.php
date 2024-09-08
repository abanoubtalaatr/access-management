<?php

namespace App\Http\Controllers\Api\Sales;

use App\Actions\CreateSaleOrderLineAction;
use App\Actions\SaleOrder\RecalculateSalesOrderOrderAction;
use App\Actions\SaleOrder\UpdateSalesOrderLinePriceAction;
use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\SalesOrderLine\SalesOrderLineRequest;
use App\Http\Resources\Api\SalesOrderLineResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\SalesOrderLine;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SalesOrderLineController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', SalesOrderLine::class);

        return SalesOrderLineResource::collection(RequestQueryBuilder::build(SalesOrderLine::query(), $request)->paginate());
    }

    public function store(
        SalesOrderLineRequest $request,
        CreateSaleOrderLineAction $createSaleOrderLineAction,
        RecalculateSalesOrderOrderAction $recalculateSalesOrderOrderAction
    ): SalesOrderLineResource {
        $this->authorize('create', SalesOrderLine::class);

        $salesOrderLine = $createSaleOrderLineAction($request->validated());

        $recalculateSalesOrderOrderAction($salesOrderLine->salesOrder);

        return SalesOrderLineResource::make($salesOrderLine);
    }

    public function show(SalesOrderLine $salesOrderLine): SalesOrderLineResource
    {
        $this->authorize('view', $salesOrderLine);

        return SalesOrderLineResource::make($salesOrderLine);
    }

    public function update(
        SalesOrderLineRequest $request,
        SalesOrderLine $salesOrderLine,
        RecalculateSalesOrderOrderAction $recalculateSalesOrderOrderAction,
        UpdateSalesOrderLinePriceAction $updateSalesOrderLinePriceAction
    ): SalesOrderLineResource {
        $this->authorize('update', $salesOrderLine);

        $salesOrderLine->update($request->validated());

        $updateSalesOrderLinePriceAction($request->validated(), $salesOrderLine->refresh());

        $recalculateSalesOrderOrderAction($salesOrderLine->refresh()->salesOrder);

        return SalesOrderLineResource::make($salesOrderLine);
    }

    public function destroy(
        SalesOrderLine $salesOrderLine,
        RecalculateSalesOrderOrderAction $recalculateSalesOrderOrderAction
    ): SuccessResponse {
        $this->authorize('delete', $salesOrderLine);

        $recalculateSalesOrderOrderAction($salesOrderLine->salesOrder);

        $salesOrderLine->delete();

        return new SuccessResponse();
    }
}
