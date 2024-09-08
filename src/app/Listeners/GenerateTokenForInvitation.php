<?php

namespace App\Listeners;

use App\Events\InvitationCreated;
use Illuminate\Support\Str;

class GenerateTokenForInvitation
{
    /**
     * Handle the event.
     */
    public function handle(InvitationCreated $event): void
    {
        $event->invitation->update([
            'invitation_token' => Str::random(),
        ]);
    }
}
