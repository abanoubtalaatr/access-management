<?php

namespace App\Models;

use App\Models\Queries\AccountQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Account extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'accountable_id',
        'accountable_type',
        'is_global',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public function newEloquentBuilder($query): AccountQueryBuilder
    {
        return new AccountQueryBuilder($query);
    }

    public function accountable()
    {
        return $this->morphTo();
    }

    public function purchaseOrderTransactions()
    {
        return $this->hasMany(PurchaseOrderTransaction::class);
    }

    public function salesTransactions()
    {
        return $this->hasMany(SalesTransaction::class);
    }
}
