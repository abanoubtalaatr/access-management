<?php

namespace App\Http\Controllers\Api\Expense;

use App\Enums\ExpenseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Expense;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MarkIsPaidController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Request $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $expense->update(['status' => ExpenseStatusEnum::PAID->value]);

        return new SuccessResponse();
    }
}
