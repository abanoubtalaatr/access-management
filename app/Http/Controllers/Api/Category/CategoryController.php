<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Category;
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
