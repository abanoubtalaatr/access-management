<?php

namespace App\Models\Queries;

use Illuminate\Database\Eloquent\Builder;

class ExpenseTransactionQueryBuilder extends Builder
{
    public function account($account)
    {
        return $this->where('account_id', $account);
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
