<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class InvoiceQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
