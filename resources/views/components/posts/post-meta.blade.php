@props(['post'])
<div style="color: gray;">
    {{$post->author->name}} |
    Posted on
    <span>{{$post->publish_date}}</span>
</div>
