<?php

namespace App\Models;

use App\Models\Queries\ClientQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Client extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'address', 'email', 'phone'];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    public function newEloquentBuilder($query): ClientQueryBuilder
    {
        return new ClientQueryBuilder($query);
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function account()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function salesOrderTransactions()
    {
        return $this->hasManyThrough(SalesTransaction::class, Account::class, 'accountable_id', 'account_id')
            ->where('accounts.accountable_type', Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function salesTransactions()
    {
        return $this->hasMany(SalesTransaction::class);
    }
}
