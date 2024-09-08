<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Resources\Api\UnitResource;
use BirdSol\AccessManagement\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryUnitController extends Controller
{
    public function index(Category $category): AnonymousResourceCollection
    {
        return UnitResource::collection($category->units()->paginate());
    }
}
