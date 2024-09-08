<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class PurchaseOrderLineQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function purchaseOrder($purchaseOrder)
    {
        return $this->where('purchase_order_id', $purchaseOrder);
    }

    public function product($product)
    {
        return $this->where('product_id', $product);
    }

    public function account($account)
    {
        return $this->where('account_id', $account);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
