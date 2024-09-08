<?php

namespace App\Models;

use App\Models\Queries\SalesTransactionQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SalesTransaction extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'sales_order_id',
        'invoice_number',
        'account_id',
        'amount',
        'client_id',
        'notes',
        'collect_date',
    ];

    public function newEloquentBuilder($query): SalesTransactionQueryBuilder
    {
        return new SalesTransactionQueryBuilder($query);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }
}
