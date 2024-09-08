<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class PurchaseRequestQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function product($product)
    {
        return $this->where('product_id', $product);
    }

    public function status($status)
    {
        return $this->where('status', $status);
    }

    public function account($account)
    {
        return $this->where('account_id', $account);
    }

    public function station($station)
    {
        return $this->where('station_id', $station);
    }

    public function supplier($supplier)
    {
        return $this->where('supplier_id', $supplier);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
