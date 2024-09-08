<?php

namespace App\Models;

use App\Models\Queries\ExpenseQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Expense extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'reference_number',
        'station_id',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
            'amount' => 'double',
            'reference_number' => 'string',
            'station_id' => 'integer',
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'reference_number' => $this->reference_number,
        ];
    }

    public function newEloquentBuilder($query): ExpenseQueryBuilder
    {
        return new ExpenseQueryBuilder($query);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expense) {
            $expense->reference_number = $expense->reference_number ?? Str::random(10);
        });
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
