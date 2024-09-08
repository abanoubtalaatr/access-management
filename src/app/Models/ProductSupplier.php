<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSupplier extends Pivot
{
    use HasFactory;

    protected $table = 'product_supplier';

    protected $fillable = ['product_id', 'supplier_id', 'price'];

    protected function casts(): array
    {
        return [
            'price' => 'float',
            'product_id' => 'integer',
            'supplier_id' => 'integer',
        ];
    }
}
