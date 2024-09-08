<?php

namespace App\Http\Controllers\Api\Unit;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\UnitRequest;
use App\Http\Resources\Api\UnitResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Unit::class);

        return UnitResource::collection(RequestQueryBuilder::build(Unit::query(), $request)->paginate());
    }

    public function store(UnitRequest $request): UnitResource
    {
        $this->authorize('create', Unit::class);

        $unit = Unit::create($request->validated());

        return UnitResource::make($unit);
    }

    public function show(Unit $unit): UnitResource
    {
        $this->authorize('view', $unit);

        return UnitResource::make($unit);
    }

    public function update(UnitRequest $request, Unit $unit): UnitResource
    {
        $this->authorize('update', $unit);

        $unit->update($request->validated());

        return UnitResource::make($unit->refresh());
    }

    public function destroy(Unit $unit): SuccessResponse
    {
        $this->authorize('delete', $unit);

        $unit->delete();

        return new SuccessResponse();
    }
}
