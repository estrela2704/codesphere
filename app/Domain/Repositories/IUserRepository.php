<?php

namespace App\Domain\Repositories;

interface IUserRepository
{
    function findById($id);
    function findByEmail($email);
    function update(array $params, $id);
    function create(array $userData);
    function delete($id);
}