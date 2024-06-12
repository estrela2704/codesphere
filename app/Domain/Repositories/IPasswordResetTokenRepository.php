<?php

namespace App\Domain\Repositories;

interface IPasswordResetTokenRepository
{
    function findByEmail($email);
    function create(array $data);
    function delete($id);
}