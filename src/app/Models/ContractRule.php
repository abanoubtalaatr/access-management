<?php

namespace App\Models;

use App\Models\Queries\ContractRuleQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ContractRule extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'contract_id',
        'number_or_percentage',
        'fee_per_liter',
        'is_protein',
        'is_bacteria',
        'is_fat',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'contract_id' => $this->contract_id,
            'number_or_percentage' => $this->number_or_percentage,
            'fee_per_liter' => $this->fee_per_liter,
            'is_protein' => $this->is_protein,
            'is_fat' => $this->is_fat,
            'is_bacteria' => $this->is_bacteria,
        ];
    }

    public function newEloquentBuilder($query): ContractRuleQueryBuilder
    {
        return new ContractRuleQueryBuilder($query);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
