<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class SalesOrderQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function client($client)
    {
        return $this->where('client_id', $client);
    }

    public function milkSales($milkSales)
    {
        return $this->where('is_milk_sales', $milkSales);
    }

    public function createdAt($date)
    {
        [$startDate, $endDate] = explode('-', $date);

        return $this->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
