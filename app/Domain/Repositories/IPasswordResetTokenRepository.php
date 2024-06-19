<?php

namespace App\Domain\Repositories;

interface IPasswordResetTokenRepository extends IGenericRepository
{
    function findByEmail($email);
}