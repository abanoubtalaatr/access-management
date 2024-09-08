<?php

namespace App\Http\Controllers\Api\MilkWeight;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\MilkWeightRequest;
use App\Http\Resources\Api\MilkWeightResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\MilkWeight;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MilkWeightController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', MilkWeight::class);

        return MilkWeightResource::collection(RequestQueryBuilder::build(MilkWeight::query(), $request)->paginate());
    }

    public function store(MilkWeightRequest $request): MilkWeightResource
    {
        $this->authorize('create', MilkWeight::class);

        $milkWeight = MilkWeight::create($request->validated());

        return MilkWeightResource::make($milkWeight);
    }

    public function show(MilkWeight $milkWeight): MilkWeightResource
    {
        $this->authorize('view', $milkWeight);

        return MilkWeightResource::make($milkWeight);
    }

    public function update(MilkWeightRequest $request, MilkWeight $milkWeight): MilkWeightResource
    {
        $this->authorize('update', $milkWeight);

        $milkWeight->update($request->validated());

        return MilkWeightResource::make($milkWeight->refresh());
    }

    public function destroy(MilkWeight $milkWeight): SuccessResponse
    {
        $this->authorize('delete', $milkWeight);

        $milkWeight->delete();

        return new SuccessResponse();
    }
}
