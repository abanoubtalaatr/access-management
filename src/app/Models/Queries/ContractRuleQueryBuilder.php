<?php

namespace App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ContractRuleQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function contract($contract): self
    {
        return $this->where('contract_id', $contract);
    }

    public function protein()
    {
        return $this->where('is_protein', 1);
    }

    public function bacteria()
    {
        return $this->where('is_bacteria', 1);
    }

    public function fat()
    {
        return $this->where('is_fat', 1);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
