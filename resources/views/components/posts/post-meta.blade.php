@props(['post'])
<div style="color: gray;">
    {{$post->author->name}} |
    Posted on
    <span>{{date('M d, Y', $post->published_at)}}</span>
</div>
