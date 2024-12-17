@props(['post'])
<div class="d-flex px-0">
    @foreach($post->tags as $tag)
        <div class="me-3">
            <a href="/" style="font-size: 0.8em">
            {{ Str::title($tag->name) }}
            </a>
        </div>
    @endforeach
</div>
