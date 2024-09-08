<?php

namespace App\Models;

use App\Models\Queries\StationQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Station extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name'];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public function newEloquentBuilder($query): StationQueryBuilder
    {
        return new StationQueryBuilder($query);
    }

    public function accounts()
    {
        return $this->morphMany(Account::class, 'accountable');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
