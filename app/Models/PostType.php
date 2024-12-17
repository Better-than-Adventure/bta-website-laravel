<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PostType extends Model
{
    protected $fillable = ['name'];

    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }

    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = $name;

        $this->attributes['slug'] = Str::slug($name);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
