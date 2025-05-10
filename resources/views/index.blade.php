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

            $iotd = (new \App\Services\RandomInfographicService())->getRandomInfographic()

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
            <hr/>
            <x-posts.small-post-list title="What's Happening?" :postTypes="['blog']"/>
            <hr/>
            <h2 class="mt-0 pb-1 mt-5 ">Tip of the Day</h2>
            <div class="pb-1 mb-2 d-flex align-items-center justify-content-between">
                <video loading="lazy" width="100%" height="100%" loop="" autoplay="autoplay" class="gallery">
                    <source src="{{asset('images/content/infographics/media/'.$iotd)}}" type="video/mp4">
                </video>
            </div>
            <div>
                <div style="color: gray;" class="metadata">
                    Art by <a href="https://twitter.com/thaboarr">@thaboarr</a>
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>
