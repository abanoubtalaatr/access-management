<?php

namespace App\Http\Controllers\Api\Contract;

use App\Models\Product;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\ContractRequest;
use App\Http\Responses\Api\SuccessResponse;
use App\Http\Resources\Api\ContractResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContractController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Contract::class);

        return ContractResource::collection(RequestQueryBuilder::build(Contract::query(), $request)->paginate());
    }

    public function store(ContractRequest $request): ContractResource
    {
        $this->authorize('create', Contract::class);

        $contract = Contract::create($request->validated());
        
        Product::where('is_milk', true)->first()->clients()->attach($contract->client_id, ['price' => $contract->price]);
        
        return ContractResource::make($contract);
    }

    public function show(Contract $contract): ContractResource
    {
        $this->authorize('view', $contract);

        return ContractResource::make($contract);
    }

    public function update(ContractRequest $request, Contract $contract): ContractResource
    {
        $this->authorize('update', $contract);

        $contract->update($request->validated());

        return ContractResource::make($contract->refresh());
    }

    public function destroy(Contract $contract): SuccessResponse
    {
        $this->authorize('delete', $contract);

        $contract->delete();

        return new SuccessResponse();
    }
}
