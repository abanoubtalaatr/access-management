<?php

namespace BirdSol\AccessManagement\App\Models\Queries;

use App\Traits\ScoutSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class InvitationQueryBuilder extends Builder
{
    use ScoutSearchable;

    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function role($role): self
    {
        return $this->where('role_id', $role);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
