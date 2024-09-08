<?php

namespace App\Models;

use App\Models\Queries\SupplierQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Supplier extends Model
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

    public function newEloquentBuilder($query): SupplierQueryBuilder
    {
        return new SupplierQueryBuilder($query);
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function account()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function purchaseOrderTransactions()
    {
        return $this->hasManyThrough(PurchaseOrderTransaction::class, Account::class, 'accountable_id', 'account_id')
            ->where('accounts.accountable_type', Supplier::class);
    }
}
