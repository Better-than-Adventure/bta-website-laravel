<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Carbon;

class RandomInfographicService
{

    public function getRandomInfographic() {
        $post = Post::where('slug', 'infographics')->first();
        $media = $post->galleryItems()->get();
        $infographics = $media->pluck('image_path')->all();
        $key = array_rand($infographics);
        return $infographics[$key];
    }

}
