<?php

namespace App\Domain\Services;

use App\Domain\Repositories\IPasswordResetTokenRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class PasswordResetService
{
    public function __construct(protected UserService $userService, protected IPasswordResetTokenRepository $passwordResetTokenRepository)
    {

    }
    public function validateResetToken(array $params)
    {
        $resetToken = $this->passwordResetTokenRepository->findByEmail($params['email']);

        if (!$resetToken) {
            return ['feedback' => 'error', 'msg' => 'Token inválido ou expirado'];
        }

        if (!Hash::check($params['token'], $resetToken->token)) {
            return ['feedback' => 'error', 'msg' => 'Token inválido'];
        }

        $expiresAt = Carbon::parse($resetToken->created_at)->addMinutes(config('auth.passwords.users.expire', 60));
        if ($expiresAt->isPast()) {
            return ['feedback' => 'error', 'msg' => 'Token expirado'];
        }

        $this->userService->updatePassword($params['email'], $params['password']);

        $this->passwordResetTokenRepository->delete($resetToken->id);

        return ['feedback' => 'success', 'msg' => 'Senha redefinida com sucesso'];
    }
    public function generateResetToken($email)
    {
        $token = Str::random(60);
        $resetToken = $this->passwordResetTokenRepository->findByEmail($email);
        if ($resetToken) {
            $this->passwordResetTokenRepository->delete($resetToken->id);
        }

        $data = [
            'email' => $email,
            'token' => bcrypt($token),
            'created_at' => Carbon::now()
        ];

        $this->passwordResetTokenRepository->create($data);

        return $token;
    }
}