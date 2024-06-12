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
        $this->userService->notify($user->id, new VerifyEmailNotification($user->name));
    }

    public function sendResetPasswordNotification(string $email): array
    {
        $token = $this->passwordResetService->generateResetToken($email);
        $user = $this->userService->getUserByEmail($email);
        if (!$user) {
            return ["feedback" => 'error', "msg" => 'Não conseguimos encontrar um usuário com esse endereço de e-mail.'];
        }
        $this->userService->notify($user->id, new ResetPasswordNotification($token));
        return ["feedback" => 'sent', "msg" => 'Enviamos o link para redefinir sua senha por e-mail.'];
    }


}