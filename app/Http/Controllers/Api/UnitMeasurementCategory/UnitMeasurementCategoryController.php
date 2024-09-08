<?php

namespace App\Http\Controllers\Api\UnitMeasurementCategory;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\UnitMeasurementCategory\UnitMeasurementCategoryRequest;
use App\Http\Resources\Api\UnitMeasurementCategory\UnitMeasurementCategoryResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\UnitMeasurementCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitMeasurementCategoryController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', UnitMeasurementCategory::class);

        return UnitMeasurementCategoryResource::collection(RequestQueryBuilder::build(UnitMeasurementCategory::query(), $request)->paginate());
    }

    public function store(UnitMeasurementCategoryRequest $request): UnitMeasurementCategoryResource
    {
        $this->authorize('create', UnitMeasurementCategory::class);

        $unitMeasurementCategory = UnitMeasurementCategory::create($request->validated());

        return UnitMeasurementCategoryResource::make($unitMeasurementCategory);
    }

    public function show(UnitMeasurementCategory $unitMeasurementCategory): UnitMeasurementCategoryResource
    {
        $this->authorize('view', $unitMeasurementCategory);

        return UnitMeasurementCategoryResource::make($unitMeasurementCategory);
    }

    public function update(UnitMeasurementCategoryRequest $request, UnitMeasurementCategory $unitMeasurementCategory): UnitMeasurementCategoryResource
    {
        $this->authorize('update', $unitMeasurementCategory);

        $unitMeasurementCategory->update($request->validated());

        return UnitMeasurementCategoryResource::make($unitMeasurementCategory->refresh());
    }

    public function destroy(UnitMeasurementCategory $unitMeasurementCategory): SuccessResponse
    {
        $this->authorize('delete', $unitMeasurementCategory);

        $unitMeasurementCategory->delete();

        return new SuccessResponse();
    }
}
