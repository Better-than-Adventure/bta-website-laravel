@php
    $media = \App\Models\GalleryItem::where('post_id', $post->id)->get();
@endphp
<x-layout.guest>
    <x-slot:heading>
        <x-page-header :title="$post->title" :image="asset('images/content/'.$post->slug.'/header/'.$post->header_image_url)"/>
    </x-slot:heading>
    <div class="content mb-2" x-data="
        {
            open: false,
            selected: { path: '', type: '', desc: '' },
            toggleOpen(selected) {
                this.open = true;
                this.selected = selected
            },
            close() {
                this.open = false;
            }
        }">
        <div x-show="open" @click="close()" id="enlarged" class="image-enlarger">
            <template x-if="selected.type == 'image'">
                <img x-transition x-show="open"  x-bind:src="selected.path">
            </template>
            <template x-if="selected.type == 'video'">
                <video x-transition x-show="open" loading="lazy" width="100%" height="100%" loop="" autoplay="autoplay" x-init="$watch('selected', () => $el.load())">
                    <source x-bind:src="selected.path" type="video/mp4">
                </video>
            </template>
            <div class="mt-3" x-text="selected.desc"></div>
        </div>
        @if($post->video)
            <div class="mb-3">
                <x-youtube-embed code="{{$post->video}}"/>
            </div>
        @endif
        <x-markdown>{{$post->content}}</x-markdown>
        <div class="row g-2">
            @foreach($media as $item)
                <div class="col-auto col-md-4">
                    @if(Str::afterLast($item->image_path, '.') == 'mp4')
                        <video loading="lazy" width="100%" height="100%" loop="" autoplay="autoplay" class="gallery" @click="toggleOpen({ path: '{{asset('images/content/'.$post->slug.'/media/'.$item->image_path)}}', type: 'video', desc: '{{$item->image_description}}'})" >
                            <source src="{{asset('images/content/'.$post->slug.'/media/'.$item->image_path)}}" type="video/mp4">
                        </video>
                    @else
                        <img style="cursor: pointer" @click="toggleOpen({ path: '{{asset('images/content/'.$post->slug.'/media/'.$item->image_path)}}', type: 'image', desc: '{{$item->image_description}}'})" class="gallery" src="{{asset('images/content/'.$post->slug.'/media/'.$item->image_path)}}" alt="{{$item->image_description}}">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-layout.guest>
