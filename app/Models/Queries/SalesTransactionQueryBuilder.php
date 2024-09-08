<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class SalesTransactionQueryBuilder extends Builder
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

    public function client($client)
    {
        return $this->where('client', $client);
    }

    public function salesOrder($salesOrder)
    {
        return $this->where('sales_order_id', $salesOrder);
    }

    public function startAt($startAt)
    {
        return $this->where('created_at', '>=', $startAt);
    }

    public function endAt($endAt)
    {
        return $this->where('created_at', '<=', $endAt);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
