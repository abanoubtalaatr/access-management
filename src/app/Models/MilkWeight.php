<?php

namespace App\Models;

use App\Models\Queries\MilkWeightQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class MilkWeight extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'weight',
        'station_id',
        'sales_order_id',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'weight' => $this->weight,
        ];
    }

    public function newEloquentBuilder($query): MilkWeightQueryBuilder
    {
        return new MilkWeightQueryBuilder($query);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }
}
