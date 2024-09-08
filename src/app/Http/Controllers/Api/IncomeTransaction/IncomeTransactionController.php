<?php

namespace App\Http\Controllers\Api\IncomeTransaction;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\IncomeTransactionRequest;
use App\Http\Resources\Api\IncomeTransactionResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\IncomeTransaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IncomeTransactionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', IncomeTransaction::class);

        return IncomeTransactionResource::collection(RequestQueryBuilder::build(IncomeTransaction::query(), $request)->paginate());
    }

    public function store(IncomeTransactionRequest $request): IncomeTransactionResource
    {
        $this->authorize('create', IncomeTransaction::class);

        $incomeTransaction = IncomeTransaction::create($request->validated());

        return IncomeTransactionResource::make($incomeTransaction);
    }

    public function show(IncomeTransaction $incomeTransaction): IncomeTransactionResource
    {
        $this->authorize('view', $incomeTransaction);

        return IncomeTransactionResource::make($incomeTransaction);
    }

    public function update(IncomeTransactionRequest $request, IncomeTransaction $incomeTransaction): IncomeTransactionResource
    {
        $this->authorize('update', $incomeTransaction);

        $incomeTransaction->update($request->validated());

        return IncomeTransactionResource::make($incomeTransaction->refresh());
    }

    public function destroy(IncomeTransaction $incomeTransaction): SuccessResponse
    {
        $this->authorize('delete', $incomeTransaction);

        $incomeTransaction->delete();

        return new SuccessResponse();
    }
}
