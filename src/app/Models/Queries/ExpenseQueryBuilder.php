<?php

namespace App\Models\Queries;

use Illuminate\Database\Eloquent\Builder;

class ExpenseQueryBuilder extends Builder
{
    public function station($stationId): self
    {
        return $this->where('station_id', $stationId);
    }

    public function status($status): self
    {
        return $this->where('status', $status);
    }

    public function sort($typeString)
    {
        [$column, $direction] = explode('-', $typeString);

        return $this->orderBy($column, $direction);
    }
}
