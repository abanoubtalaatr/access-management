<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class PurchaseOrderQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function account($account)
    {
        return $this->where('account_id', $account);
    }

    public function purchaseRequests()
    {
        return $this->where('is_request', 1);
    }

    public function station($station)
    {
        return $this->where('station_id', $station);
    }

    public function isRequest($purchaseOrderStatus)
    {
        return $this->where('is_request', $purchaseOrderStatus);
    }

    public function isCanceled($canceled)
    {
        return $this->where('is_canceled', $canceled);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
