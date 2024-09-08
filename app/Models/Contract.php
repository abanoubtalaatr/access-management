<?php

namespace App\Models;

use App\Models\Queries\ContractQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Contract extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'client_id',
        'start_date',
        'end_date',
        'price',
        'delivery_fees',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'price' => $this->price,
        ];
    }

    public function newEloquentBuilder($query): ContractQueryBuilder
    {
        return new ContractQueryBuilder($query);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function contractRules()
    {
        return $this->hasMany(ContractRule::class);
    }
}
