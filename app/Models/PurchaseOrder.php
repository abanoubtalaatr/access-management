<?php

namespace App\Models;

use App\Models\Queries\PurchaseOrderQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class PurchaseOrder extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'reference_number',
        'station_id',
        'supplier_id',
        'price',
        'tax',
        'total',
        'status',
        'is_request',
        'is_canceled',
        'description',
        'sub_total',
    ];

    protected function casts(): array
    {
        return [
            'account_id' => 'integer',
            'station_id' => 'integer',
            'supplier_id' => 'integer',
            'reference_number' => 'string',
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($purchaseOrder) {
            $purchaseOrder->reference_number = $purchaseOrder->reference_number ?? Str::random(10);
        });
    }

    public function newEloquentBuilder($query): PurchaseOrderQueryBuilder
    {
        return new PurchaseOrderQueryBuilder($query);
    }

    public function purchaseOrderLines()
    {
        return $this->hasMany(PurchaseOrderLine::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrderTransactions()
    {
        return $this->hasMany(PurchaseOrderTransaction::class);
    }
}
