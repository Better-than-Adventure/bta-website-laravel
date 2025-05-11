@props([
    'title' => '',
    'total' => 3,
    'postTypes' => []
 ])

@php
    use App\Models\Post;use Illuminate\Support\Carbon;

    $posts = Post::whereHas('postType', function ($query) use($postTypes) {
        $query->whereIn('slug', $postTypes);
     })
     ->where('published_at', '<=', Carbon::now())
     ->take($total)->orderBy('published_at', 'desc')->get()
@endphp


<h2 class="pb-1">{{$title}}</h2>
@foreach($posts as $post)
    <div class="d-flex px-0 pb-3">
        <img src="{{asset('images/content/'.$post->slug.'/header/'.$post->header_image_url)}}" class="post-thumb"
             alt=""/>
        <div>
            <x-posts.post-meta :post="$post"/>
            <h4 class="post-title mt-0">{{$post->title}}</h4>
            <a href="{{route('posts.view', ['postType' => $post->postType, 'post' => $post])}}">
                <div>Read Post »</div>
            </a>
        </div>
    </div>
@endforeach
