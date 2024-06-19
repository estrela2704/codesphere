<?php

namespace App\Domain\Repositories;


interface IGenericRepository
{
    public function all();

    public function findById($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
}