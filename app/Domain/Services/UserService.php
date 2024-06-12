<?php

namespace App\Domain\Services;

use App\Domain\Repositories\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserService
{
    public function __construct(protected IUserRepository $userRepository)
    {
    }
    public function create(array $data)
    {
        $this->userRepository->create($data);
        $user = $this->userRepository->findByEmail($data['email']);
        return $user;
    }

    public function update($userData, int $id)
    {
        $this->userRepository->update($userData, $id);
    }
    public function notify(int $id, $instance)
    {
        $user = $this->userRepository->findById($id);
        $user->notify($instance);
    }

    public function getUserByEmail(string $email)
    {
        return $this->userRepository->findByEmail($email);
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
        $params = [
            'email_verified_at' => Carbon::now()
        ];
        $this->userRepository->update($params, $user->id);
    }

    public function updatePassword($email, $newPassword): void
    {
        $user = $this->userRepository->findByEmail($email);
        $params = [
            'password' => Hash::make($newPassword),
        ];
        $this->userRepository->update($params, $user->id);
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->findById($id);
        $this->userRepository->delete($user->id);
    }
}