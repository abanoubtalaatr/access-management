<?php

namespace App\Http\Controllers\Api\ExpenseTransaction;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\ExpenseTransactionRequest;
use App\Http\Resources\Api\ExpenseTransactionResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\ExpenseTransaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExpenseTransactionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', ExpenseTransaction::class);

        return ExpenseTransactionResource::collection(RequestQueryBuilder::build(ExpenseTransaction::query(), $request)->paginate());
    }

    public function store(ExpenseTransactionRequest $request): ExpenseTransactionResource
    {
        $this->authorize('create', ExpenseTransaction::class);

        $expenseTransaction = ExpenseTransaction::create($request->validated());

        return ExpenseTransactionResource::make($expenseTransaction);
    }

    public function show(ExpenseTransaction $expenseTransaction): ExpenseTransactionResource
    {
        $this->authorize('view', $expenseTransaction);

        return ExpenseTransactionResource::make($expenseTransaction);
    }

    public function update(ExpenseTransactionRequest $request, ExpenseTransaction $expenseTransaction): ExpenseTransactionResource
    {
        $this->authorize('update', $expenseTransaction);

        $expenseTransaction->update($request->validated());

        return ExpenseTransactionResource::make($expenseTransaction->refresh());
    }

    public function destroy(ExpenseTransaction $expenseTransaction): SuccessResponse
    {
        $this->authorize('delete', $expenseTransaction);

        $expenseTransaction->delete();

        return new SuccessResponse();
    }
}
