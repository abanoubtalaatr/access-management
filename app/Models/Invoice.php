<?php

namespace App\Models;

use App\Models\Queries\InvoiceQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Invoice extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['invoice_number', 'sales_order_id'];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
        ];
    }

    public function newEloquentBuilder($query): InvoiceQueryBuilder
    {
        return new InvoiceQueryBuilder($query);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function salesTransactions()
    {
        return $this->hasMany(SalesTransaction::class);
    }
}
