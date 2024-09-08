<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientProduct extends Pivot
{
    use HasFactory;

    protected $table = 'client_product';

    protected $fillable = ['product_id', 'client_id', 'price'];

    protected function casts(): array
    {
        return [
            'price' => 'float',
            'product_id' => 'integer',
            'client_id' => 'integer',
        ];
    }
}
