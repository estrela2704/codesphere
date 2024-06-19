<?php

namespace App\Infra\Repositories;

use App\Infra\Models\Post;
use App\Domain\Repositories\IPostRepositoryInterface;

class PostRepositoryEloquent implements IPostRepositoryInterface
{
    function all()
    {
        return Post::all();
    }
    function findById($id)
    {
        return Post::find($id);
    }
    function update(array $data, $id)
    {
        $post = $this->findById($id);
        $post->update($data);
        return $post;
    }
    function create(array $data)
    {
        return Post::create($data);
    }
    function delete($id)
    {
        $post = $this->findById($id);
        return $post->delete();
    }
}