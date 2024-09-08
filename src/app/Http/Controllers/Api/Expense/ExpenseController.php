<?php

namespace App\Http\Controllers\Api\Expense;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\ExpenseRequest;
use App\Http\Resources\Api\ExpenseResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Expense;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExpenseController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Expense::class);

        return ExpenseResource::collection(
            RequestQueryBuilder::build(Expense::query(), $request)->paginate()
        );
    }

    public function store(ExpenseRequest $request): ExpenseResource
    {
        $this->authorize('create', Expense::class);

        $expense = Expense::create($request->validated());

        return ExpenseResource::make($expense->refresh());
    }

    public function show(Expense $expense): ExpenseResource
    {
        $this->authorize('view', $expense);

        return ExpenseResource::make($expense);
    }

    public function update(ExpenseRequest $request, Expense $expense): ExpenseResource
    {
        $this->authorize('update', $expense);

        $expense->update($request->validated());

        return ExpenseResource::make($expense);
    }

    public function destroy(Expense $expense): SuccessResponse
    {
        $this->authorize('delete', $expense);

        $expense->delete();

        return new SuccessResponse();
    }
}
