<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderLineStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'station_id',
        'sales_order_line_id',
        'weight',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }
}
