<?php

namespace App\Http\Controllers\Api\PurchaseRequest;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\PurchaseRequestRequest;
use App\Http\Resources\Api\PurchaseRequestResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\PurchaseRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PurchaseRequestController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', PurchaseRequest::class);

        return PurchaseRequestResource::collection(RequestQueryBuilder::build(PurchaseRequest::query(), $request)->paginate());
    }

    public function store(PurchaseRequestRequest $request): PurchaseRequestResource
    {
        $this->authorize('create', PurchaseRequest::class);

        $purchaseRequest = PurchaseRequest::create($request->validated());

        return PurchaseRequestResource::make($purchaseRequest->refresh());
    }

    public function show(PurchaseRequest $purchaseRequest): PurchaseRequestResource
    {
        $this->authorize('view', $purchaseRequest);

        return PurchaseRequestResource::make($purchaseRequest);
    }

    public function update(PurchaseRequestRequest $request, PurchaseRequest $purchaseRequest): PurchaseRequestResource
    {
        $this->authorize('update', $purchaseRequest);

        $purchaseRequest->update($request->validated());

        return PurchaseRequestResource::make($purchaseRequest);
    }

    public function destroy(PurchaseRequest $purchaseRequest): SuccessResponse
    {
        $this->authorize('delete', $purchaseRequest);

        $purchaseRequest->delete();

        return new SuccessResponse();
    }
}
