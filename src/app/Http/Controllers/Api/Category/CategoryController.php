<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Queries\RequestQueryBuilder;
use BirdSol\AccessManagement\Http\Requests\Api\CategoryRequest;
use BirdSol\AccessManagement\Http\Resources\Api\CategoryResource;
use BirdSol\AccessManagement\Http\Responses\Api\SuccessResponse;
use BirdSol\AccessManagement\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Category::class);

        return CategoryResource::collection(RequestQueryBuilder::build(Category::query(), $request)->paginate());
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        $this->authorize('create', Category::class);

        $category = Category::create($request->validated());

        return CategoryResource::make($category);
    }

    public function show(Category $category): CategoryResource
    {
        $this->authorize('view', $category);

        return CategoryResource::make($category);
    }

    public function update(CategoryRequest $request, Category $category): CategoryResource
    {
        $this->authorize('update', $category);

        $category->update($request->validated());

        return CategoryResource::make($category->refresh());
    }

    public function destroy(Category $category): SuccessResponse
    {
        $this->authorize('delete', $category);

        $category->delete();

        return new SuccessResponse();
    }
}
