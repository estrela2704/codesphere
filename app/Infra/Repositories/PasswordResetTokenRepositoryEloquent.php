<?php

namespace App\Infra\Repositories;

use App\Domain\Repositories\IPasswordResetTokenRepository;
use Illuminate\Support\Facades\DB;

class PasswordResetTokenRepositoryEloquent implements IPasswordResetTokenRepository
{
    function all()
    {
    }
    function findById($id)
    {
        return DB::table('password_reset_tokens')
            ->where('id', $id)
            ->first();
    }
    function update(array $params, $id)
    {
        $passwordResetToken = $this->findById($id);
        $passwordResetToken->update($params);
    }
    function findByEmail($email)
    {
        return DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();
    }
    function create(array $data)
    {
        DB::table('password_reset_tokens')->insert([
            'email' => $data['email'],
            'token' => $data['token'],
            'created_at' => $data['created_at']
        ]);
    }
    function delete($id)
    {
        DB::table('password_reset_tokens')->where('id', $id)->delete();
    }
}