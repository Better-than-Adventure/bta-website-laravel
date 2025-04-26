<x-layout.guest>
    <x-slot:heading>
        <x-page-header :title="$post->title" :image="asset('images/content/'.$post->slug.'/header/'.$post->header_image_url)"/>
    </x-slot:heading>
    <div class="content py-4 mb-2">
        @if($post->video)
            <x-youtube-embed code="{{$post->video}}"/>
        @endif
        <x-markdown>{{$post->content}}</x-markdown>
    </div>
</x-layout.guest>
