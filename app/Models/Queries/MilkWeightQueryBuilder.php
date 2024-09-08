<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class MilkWeightQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function salesOrder($salesOrder)
    {
        return $this->where('sales_order_id', $salesOrder);
    }

    public function station($station)
    {
        return $this->where('station_id', $station);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
