<?php

namespace App\Domain\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class PasswordResetService
{
    public function __construct(protected UserService $userService)
    {

    }
    public function validateResetToken(array $params)
    {
        $resetToken = DB::table('password_reset_tokens')
            ->where('email', $params['email'])
            ->first();

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

        $this->userService->updatePassword($this->userService->getUserByEmail($params['email']), $params['password']);

        DB::table('password_reset_tokens')->where('email', $params['email'])->delete();

        return ['feedback' => 'success', 'msg' => 'Senha redefinida com sucesso'];
    }
    public static function generateResetToken($email)
    {
        $token = Str::random(60);
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => bcrypt($token),
            'created_at' => Carbon::now()
        ]);
        return $token;
    }
}