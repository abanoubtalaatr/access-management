<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UnitResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryUnitController extends Controller
{
    public function index(Category $category): AnonymousResourceCollection
    {
        return UnitResource::collection($category->units()->paginate());
    }
}
