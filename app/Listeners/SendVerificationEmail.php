<?php

namespace App\Listeners;

use App\Domain\Services\NotificationService;
use App\Events\UserRegistred;


class SendVerificationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct(protected NotificationService $notificationService)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistred $event): void
    {
        $this->notificationService->sendVerifyEmailNotification($event->email);
    }
}
