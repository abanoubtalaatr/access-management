<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Contract;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Queries\RequestQueryBuilder;
use BirdSol\AccessManagement\Http\Requests\Api\ContractRuleRequest;
use BirdSol\AccessManagement\Http\Resources\Api\ContractRuleResource;
use BirdSol\AccessManagement\Http\Responses\Api\SuccessResponse;
use BirdSol\AccessManagement\Models\ContractRule;
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
