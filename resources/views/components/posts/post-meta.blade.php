@props(['post'])
<div style="color: gray;">
    {{$post->author->name}} |
    Posted on
    <span>{{$post->published_at->format('M d, Y')}}</span>
</div>
