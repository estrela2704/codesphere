<?php

namespace App\Domain\Repositories;

interface IUserRepository extends IGenericRepository
{
    function findByEmail($email);
}