<x-layout.guest>
    <div class="content">
        <img src="{{asset('images/content/'.$post->slug.'/header/'.$post->header_image_url)}}" class="post-header" />
    </div>
    <div class="content py-4 mb-2">
        <div class="d-flex justify-content-between">
            <x-posts.post-tags :post="$post"/>
            <x-posts.post-meta :post="$post"/>
        </div>
        <h1 class="mb-3">{{$post->title}}</h1>
        @if($post->video)
            <x-youtube-embed code="{{$post->video}}"/>
        @endif
        <x-markdown>{{$post->content}}</x-markdown>
    </div>
</x-layout.guest>
