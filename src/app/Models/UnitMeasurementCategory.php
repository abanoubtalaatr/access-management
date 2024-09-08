<?php

namespace App\Models;

use App\Models\Queries\UnitMeasurementCategoryQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class UnitMeasurementCategory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'is_volume',
        'is_weight',
        'is_unit',
    ];

    public function casts()
    {
        return [
            'name' => 'string',
            'is_volume' => 'boolean',
            'is_weight' => 'boolean',
            'is_unit' => 'boolean',
        ];
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public function newEloquentBuilder($query): UnitMeasurementCategoryQueryBuilder
    {
        return new UnitMeasurementCategoryQueryBuilder($query);
    }
}
