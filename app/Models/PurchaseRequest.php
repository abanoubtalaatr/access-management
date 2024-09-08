<?php

namespace App\Models;

use App\Models\Queries\PurchaseRequestQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PurchaseRequest extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['product_id', 'account_id', 'station_id', 'quantity', 'supplier_id', 'justification', 'status'];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
        ];
    }

    public function newEloquentBuilder($query): PurchaseRequestQueryBuilder
    {
        return new PurchaseRequestQueryBuilder($query);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function getTotalAttribute()
    {
        $price = $this->quantity * $this->product->selling_price;
        $tax = ($price * $this->product->tax) / 100;

        return $price + $tax;
    }
}
