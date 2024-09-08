<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Queries\IncomeTransactionQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeTransaction extends Model
{
    use HasFactory, Searchable;
    
    protected $fillable = ['account_id', 'amount', 'notes', 'collect_date'];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'collect_date' => $this->collect_date,
        ];
    }

    public function newEloquentBuilder($query): IncomeTransactionQueryBuilder
    {
        return new IncomeTransactionQueryBuilder($query);
    }
    
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
