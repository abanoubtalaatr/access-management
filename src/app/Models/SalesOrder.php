<?php

namespace App\Models;

use App\Models\Queries\SalesOrderQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class SalesOrder extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'client_id',
        'delivery_date',
        'payment_due_date',
        'invoice_number',
        'is_milk_sales',
        'total',
        'price',
        'tax',
        'status',
        'description',
        'fat_percentage',
        'protein_percentage',
        'bacteria_number',
        'contract_revenue',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'description' => $this->description,
            'price' => $this->price,
        ];
    }

    public function newEloquentBuilder($query): SalesOrderQueryBuilder
    {
        return new SalesOrderQueryBuilder($query);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($salesOrder) {
            $salesOrder->invoice_number = $salesOrder->invoice_number ?? Str::random(10);
        });
    }

    public function salesOrderLines()
    {
        return $this->hasMany(SalesOrderLine::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function milkWeights()
    {
        return $this->hasMany(MilkWeight::class);
    }

    public function salesTransactions()
    {
        return $this->hasMany(SalesTransaction::class);
    }
}
