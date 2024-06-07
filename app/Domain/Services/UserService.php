<?php

namespace App\Domain\Services;

use App\Infra\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserService
{
    public function create(array $data): User
    {
        $user = User::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'birth_date' => $data['birth_date'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
        return $user;
    }

    public function notify(User $user, $instance)
    {
        $user->notify($instance);
    }

    public function getUserByEmail(string $email): User|null
    {
        return User::where('email', $email)->first();
    }

    public function hasVerifiedEmail(string $email): bool
    {
        $user = $this->getUserByEmail($email);
        if (($user->email_verified_at == '') && ($user->email_verified_at == NULL)) {
            return false;
        }
        return true;
    }

    public function markHasVerified(string $email): void
    {
        $user = $this->getUserByEmail($email);
        $user->update([
            'email_verified_at' => Carbon::now()
        ]);
    }

    public function updatePassword(User $user, $newPassword): void
    {
        $user->update([
            'password' => Hash::make($newPassword),
        ]);
    }
}