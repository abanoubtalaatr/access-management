<?php

namespace App\Models;

use App\Models\Queries\ExpenseTransactionQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ExpenseTransaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'account_id',
        'collect_date',
        'amount',
        'notes',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'notes' => $this->notes,
        ];
    }

    public function newEloquentBuilder($query): ExpenseTransactionQueryBuilder
    {
        return new ExpenseTransactionQueryBuilder($query);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
