<?php

namespace App\Listeners;

use App\Events\InvitationCreated;
use App\Notifications\InvitationNotification;

class NotifyEmailOfInvitation
{
    /**
     * Handle the event.
     */
    public function handle(InvitationCreated $event): void
    {
        $event->invitation->notify(new InvitationNotification($event->invitation));
    }
}
