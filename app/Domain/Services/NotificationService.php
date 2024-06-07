<?php

namespace App\Domain\Services;

use App\Application\Notifications\ResetPasswordNotification;
use App\Application\Notifications\VerifyEmailNotification;


class NotificationService
{
    public function __construct(protected PasswordResetService $passwordResetService, protected UserService $userService)
    {
    }

    public function sendVerifyEmailNotification(string $email): void
    {
        $user = $this->userService->getUserByEmail($email);
        $this->userService->notify($user, new VerifyEmailNotification($user->name));
    }

    public function sendResetPasswordNotification(string $email): void
    {
        $token = $this->passwordResetService->generateResetToken($email);
        $user = $this->userService->getUserByEmail($email);
        $this->userService->notify($user, new ResetPasswordNotification($token));
    }


}