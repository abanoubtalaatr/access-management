<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ProductQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function category($category)
    {
        return $this->where('category_id', $category);
    }

    public function unit($unit)
    {
        return $this->where('is_unit', $unit);
    }

    public function milk()
    {
        return $this->where('is_milk', 1);
    }

    public function sellable()
    {
        return $this->where('is_sellable', 1);
    }

    public function purchasable()
    {
        return $this->where('is_purchasable', 1);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
