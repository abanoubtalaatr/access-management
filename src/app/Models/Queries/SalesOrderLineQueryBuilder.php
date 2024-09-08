<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class SalesOrderLineQueryBuilder extends Builder
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

    public function client($client)
    {
        return $this->whereHas('salesOrder', function ($query) use ($client) {
            $query->where('client_id', $client);
        });
    }

    public function product($product)
    {
        return $this->where('product_id', $product);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
