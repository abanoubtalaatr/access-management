<?php

namespace App\Models;

use App\Models\Queries\UnitQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Unit extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'unit_measurement_category_id',
    ];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public function newEloquentBuilder($query): UnitQueryBuilder
    {
        return new UnitQueryBuilder($query);
    }

    public function unitMeasurementCategory()
    {
        return $this->belongsTo(UnitMeasurementCategory::class);
    }
}
