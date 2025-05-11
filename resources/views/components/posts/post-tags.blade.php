@props(['post'])
<div class="d-flex px-0">
    @foreach($post->tags as $tag)
        <div class="me-3">
            <a href="{{route('posts.list', ['postType' => $post->postType, 'tag' => $tag->name])}}" style="font-size: 0.8em">
            {{ Str::title($tag->name) }}
            </a>
        </div>
    @endforeach
</div>
