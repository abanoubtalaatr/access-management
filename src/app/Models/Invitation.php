<?php

namespace BirdSol\AccessManagement\App\Models;

use BirdSol\AccessManagement\App\Events\InvitationCreated;
use BirdSol\AccessManagement\App\Models\Queries\InvitationQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Spatie\Permission\Models\Role;

class Invitation extends Model
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'invitation_token',
    ];

    protected function casts(): array
    {
        return [
            'role_id' => 'integer',
            'name' => 'string',
            'email' => 'string',
            'invitation_token' => 'string',
        ];
    }

    protected $dispatchesEvents = [
        'created' => InvitationCreated::class,
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
        ];
    }

    public function newEloquentBuilder($query): InvitationQueryBuilder
    {
        return new InvitationQueryBuilder($query);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
