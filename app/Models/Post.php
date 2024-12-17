<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'summary', 'content'];

    public function getStatusAttribute(): string {
        $carbonPublishedAt = \Carbon\Carbon::parse($this->published_at);
        if($this->draft){
            return '<span class="badge bg-secondary">Draft</span>';
        } else if($carbonPublishedAt >= Carbon::now()){
            return '<span class="badge bg-warning">Scheduled</span>';
        }
        return '<span class="badge bg-success">Live</span>';
    }

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function postType(): BelongsTo {
        return $this->belongsTo(PostType::class, 'post_type_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }


    public function getFormattedTagsAttribute(): string
    {
        return $this->tags()->implode('name', ',');
    }

    public function setTitleAttribute(string $title): void
    {
        $this->attributes['title'] = $title;

        $this->attributes['slug'] = Str::slug($title);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
