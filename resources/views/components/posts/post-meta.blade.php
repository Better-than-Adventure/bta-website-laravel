@props(['post'])
<div style="color: gray;">
    {{$post->author->name}} |
    Posted on
    <span>{{$post->created_at->format('M d, Y')}}</span>
</div>
