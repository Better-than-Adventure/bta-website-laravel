<?php

namespace App\Models;

use App\Enums\EnumPostTemplates;
use Awssat\Visits\Visits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Post extends Model implements Feedable
{
    protected $fillable = ['title', 'summary', 'content'];

    public function incrementReadCount() {
        $this->read_count++;
        return $this->save();
    }

    public function getStatusAttribute(): string {
        $carbonPublishedAt = \Carbon\Carbon::parse($this->published_at);
        if($this->draft){
            return '<span class="badge bg-secondary">Draft</span>';
        } else if($carbonPublishedAt >= Carbon::now()){
            return '<span class="badge bg-warning">Scheduled</span>';
        }
        return '<span class="badge bg-success">Live</span>';
    }

    public function getPublishDateAttribute(): string {
        return \Carbon\Carbon::parse($this->published_at)->format('M d, Y');
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

    public function getUrlAttribute(): string {
        return config('app.url')."/{$this->postType->slug}/$this->slug";
    }

    public function galleryItems(): HasMany
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function getLinkAttribute(): string
    {
        return URL::route('posts.view', ['postType' => $this->postType, 'post' => $this]);
    }

    public function getFormattedTagsAttribute(): string
    {
        return $this->tags()->implode('name', ',');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function getFeedItems()
    {
        return Post::whereHas('postType', function($query){
            $query->where('post_template_enum', EnumPostTemplates::Article);
        })->where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')->get();
    }

    public function visits(): Visits
    {
        return visits($this);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->summary)
            ->updated($this->updated_at)
            ->link($this->link)
            ->image(asset('images/content/'.$this->slug.'/header/'.$this->header_image_url))
            ->authorName($this->author->name);
    }
}
