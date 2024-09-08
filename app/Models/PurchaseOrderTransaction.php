<?php

namespace App\Models;

use App\Models\Queries\PurchaseOrderTransactionsQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class PurchaseOrderTransaction extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'purchase_order_id',
        'account_id',
        'amount',
        'collection_date',
        'invoice_number',
        'notes',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($purchaseOrderTransaction) {
            $purchaseOrderTransaction->invoice_number = $purchaseOrderTransaction->reference_number ?? Str::random(10);
        });
    }

    public function newEloquentBuilder($query): PurchaseOrderTransactionsQueryBuilder
    {
        return new PurchaseOrderTransactionsQueryBuilder($query);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
