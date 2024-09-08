<?php

namespace App\Models;

use App\Models\Queries\ContactQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Contact extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'email', 'phone', 'contactable_type', 'contactable_id'];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    public function newEloquentBuilder($query): ContactQueryBuilder
    {
        return new ContactQueryBuilder($query);
    }

    public function contactable()
    {
        return $this->morphTo();
    }
}
