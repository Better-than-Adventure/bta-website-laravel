<x-layout.guest>
    <x-slot:heading>
        <x-page-header title="Home" image="images/header/home.jpg"/>
    </x-slot:heading>
    <div class="row">
        <div class="col-lg-8 mb-3">
            @php
                $post = \App\Models\Post::with('postType')->whereHas('postType', function ($query) {
                    $query->where('slug', 'homepage');
                })->first();
            @endphp
            @if(filled($post))
                @if($post->video)
                    <x-youtube-embed code="{{$post->video}}"/>
                @endif
                <x-markdown>{{$post->content}}</x-markdown>
            @endif

        </div>
        <div class="col-lg-4">
            <x-home_latest_release/>
            <hr />
            <x-posts.small-post-list title="What's Happening?" :postTypes="['blog']"/>
            <div class="pb-1 mt-5 mb-2 d-flex align-items-center justify-content-between">
                Infographs go here!
            </div>
            <div>
                <div style="color: gray;" class="metadata">
                    Art by <a href="https://twitter.com/thaboarr">@thaboarr</a>
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>
