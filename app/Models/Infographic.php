<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Infographic extends Model
{
    protected $guarded = [];

    protected $appends = ['url'];

    public function getUrlAttribute(): string {
        return asset("images/infographics/{$this->image_path}");
    }

}
