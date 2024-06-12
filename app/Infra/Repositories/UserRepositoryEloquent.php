<?php

namespace App\Infra\Repositories;

use App\Domain\Repositories\IUserRepository;
use App\Infra\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserRepositoryEloquent implements IUserRepository
{
    function findByEmail($email)
    {
        return User::where('email', $email)->first();

    }
    function findById($id)
    {
        return User::where('id', $id)->first();
    }
    function create(array $data)
    {
        User::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'birth_date' => $data['birth_date'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
    }
    function update(array $params, $id)
    {
        $user = $this->findById($id);
        $user->update($params);
    }

    function delete($id)
    {
        $user = $this->findById($id);
        $user->delete();
    }
}