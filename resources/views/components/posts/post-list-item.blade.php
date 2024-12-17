@props(['post', 'postType'])
@php
    $postType = $post->postType;
@endphp
<x-posts.post-tags :post="$post"/>
<div class="d-flex px-0 pb-3">

    <img src="{{asset('images/content/'.$post->slug.'/header/'.$post->header_image_url)}}" class="post-img"  alt=""/>
    <div class="ms-3">
        <x-posts.post-meta :post="$post"/>
        <h3 class="post-title mt-0">{{$post->title}}</h3>
        <div>{{ $post->summary }}</div>
        <a href="{{route('posts.view', compact('postType', 'post'))}}">
            <div>Read Post »</div>
        </a>
    </div>
</div>
<hr class="my-3"/>
