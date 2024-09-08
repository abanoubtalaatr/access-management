<?php

namespace App\Models;

use App\Models\Queries\ProductQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'unit_id',
        'category_id',
        'is_sellable',
        'is_purchasable',
        'selling_price',
        'purchasing_price',
        'is_milk',
        'tax',
    ];

    protected function casts(): array
    {
        return [
            'is_sellable' => 'boolean',
            'is_purchasable' => 'boolean',
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public function newEloquentBuilder($query): ProductQueryBuilder
    {
        return new ProductQueryBuilder($query);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class)->withPivot(['price']);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class)->withPivot(['price']);
    }

    public function purchaseRequests()
    {
        return $this->hasMany(PurchaseRequest::class);
    }

    public function salesOrderLines()
    {
        return $this->hasMany(SalesOrderLine::class);
    }

    public function salesOrders()
    {
        return $this->hasManyThrough(
            SalesOrder::class,
            SalesOrderLine::class,
            'product_id',
            'id',
            'id',
            'sales_order_id'
        );
    }

    public function purchaseOrders()
    {
        return $this->hasManyThrough(
            PurchaseOrder::class,
            PurchaseOrderLine::class,
            'product_id',
            'id',
            'id',
            'purchase_order_id'
        );
    }
}
