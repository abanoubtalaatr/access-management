<?php

namespace App\Http\Controllers\Api\Contract;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\ContractRuleRequest;
use App\Http\Resources\Api\ContractRuleResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\ContractRule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContractRuleController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', ContractRule::class);

        return ContractRuleResource::collection(RequestQueryBuilder::build(ContractRule::query(), $request)->paginate());
    }

    public function store(ContractRuleRequest $request): ContractRuleResource
    {
        $this->authorize('create', ContractRule::class);

        $contractRule = ContractRule::create($request->validated());

        return ContractRuleResource::make($contractRule);
    }

    public function show(ContractRule $contractRule): ContractRuleResource
    {
        $this->authorize('view', $contractRule);

        return ContractRuleResource::make($contractRule);
    }

    public function update(ContractRuleRequest $request, ContractRule $contractRule): ContractRuleResource
    {
        $this->authorize('update', $contractRule);

        $contractRule->update($request->validated());

        return ContractRuleResource::make($contractRule->refresh());
    }

    public function destroy(ContractRule $contractRule): SuccessResponse
    {
        $this->authorize('delete', $contractRule);

        $contractRule->delete();

        return new SuccessResponse();
    }
}
