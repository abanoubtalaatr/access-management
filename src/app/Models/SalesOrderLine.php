<?php

namespace App\Models;

use App\Models\Queries\SalesOrderLineQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SalesOrderLine extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'sales_order_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'taxes',
        'total_farm_weight',
        'total_client_weight',
        'fat_percentage',
        'protein_percentage',
        'bacteria_number',
        'contract_revenue',
        'sub_total',
    ];

    public function newEloquentBuilder($query): SalesOrderLineQueryBuilder
    {
        return new SalesOrderLineQueryBuilder($query);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function salesOrderStations()
    {
        return $this->hasMany(SalesOrderLineStation::class);
    }

    public function stations()
    {
        return $this->hasMany(SalesOrderLineStation::class, 'sales_order_line_id');
    }
}
