<?php

namespace App\Infra\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}