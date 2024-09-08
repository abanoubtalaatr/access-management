<?php

namespace App\Http\Controllers\Api\Sales;

use App\Actions\SaleOrder\CheckPaymentStatusAction;
use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\SalesTransactionRequest;
use App\Http\Resources\Api\SalesTransactionResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\SalesTransaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SalesTransactionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', SalesTransaction::class);

        return SalesTransactionResource::collection(RequestQueryBuilder::build(SalesTransaction::query(), $request)->paginate());
    }

    public function store(
        SalesTransactionRequest $request,
        CheckPaymentStatusAction $checkPaymentStatusAction
    ): SalesTransactionResource {
        $this->authorize('create', SalesTransaction::class);

        $salesTransaction = SalesTransaction::create($request->validated());

        $checkPaymentStatusAction($salesTransaction->salesOrder);

        return SalesTransactionResource::make($salesTransaction);
    }

    public function show(SalesTransaction $salesTransaction): SalesTransactionResource
    {
        $this->authorize('view', $salesTransaction);

        return SalesTransactionResource::make($salesTransaction);
    }

    public function update(
        SalesTransactionRequest $request,
        SalesTransaction $salesTransaction,
        CheckPaymentStatusAction $checkPaymentStatusAction
    ): SalesTransactionResource {
        $this->authorize('update', $salesTransaction);

        $salesTransaction->update($request->validated());

        $checkPaymentStatusAction($salesTransaction->salesOrder);

        return SalesTransactionResource::make($salesTransaction->refresh());
    }

    public function destroy(SalesTransaction $salesTransaction): SuccessResponse
    {
        $this->authorize('delete', $salesTransaction);

        $salesTransaction->delete();

        return new SuccessResponse();
    }
}
