<?php

namespace App\Models;

use App\Models\Queries\PurchaseOrderLineQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PurchaseOrderLine extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'price',
        'tax',
        'total',
        'sub_total',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'purchase_order_id' => $this->purchase_order_id,
            'product_id' => $this->product_id,
        ];
    }

    public function newEloquentBuilder($query): PurchaseOrderLineQueryBuilder
    {
        return new PurchaseOrderLineQueryBuilder($query);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
