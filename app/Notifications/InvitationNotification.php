<?php

namespace BirdSol\AccessManagement\Notifications;

use BirdSol\AccessManagement\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Invitation $invitation
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $invitation = $this->invitation;

        // Build the URL for the front-end
        $frontendUrl = env('FRONTEND_URL');
        $acceptUrl = $frontendUrl.'/accept-invitation?'.http_build_query([
            'invitation_id' => $invitation->id,
            'name' => $invitation->name,
            'email' => $invitation->email,
        ]);

        return (new MailMessage())
            ->subject(__('Invitation to Join Our System'))
            ->line(__('Dear :name,', ['name' => $invitation->name])) // Personalized greeting
            ->line(__('You have been invited to use our system. Please click the button below to accept the invitation.'))
            ->action(__('Accept Invitation'), $acceptUrl)
            ->line(__('Thank you for using our application!'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
