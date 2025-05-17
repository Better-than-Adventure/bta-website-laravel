@php
    $infographics = \App\Models\Infographic::all();
@endphp
<x-layout.guest>
    <x-slot:heading>
        <x-page-header title="Infographics" :image="asset('images/header/about.png')" :thaboar="true"/>
    </x-slot:heading>
    <div class="content mb-2" x-data="
        {
            open: false,
            selected: { path: '' },
            toggleOpen(selected) {
                this.open = true;
                this.selected = selected
            },
            close() {
                this.open = false;
            }
        }">
        <div x-show="open" @click="close()" id="enlarged" class="image-enlarger">
            <video x-transition x-show="open" loading="lazy" width="100%" height="100%" loop="" autoplay="autoplay" x-init="$watch('selected', () => $el.load())">
                <source x-bind:src="selected.path" type="video/mp4">
            </video>
        </div>
        <div class="row g-2">
            @foreach($infographics as $item)
                <div class="col-auto col-md-4">
                    <video loading="lazy" width="100%" height="100%" loop="" autoplay="autoplay" class="gallery" @click="toggleOpen({ path: '{{asset($item->url)}}'})" >
                        <source src="{{asset($item->url)}}" type="video/mp4">
                    </video>
                </div>
            @endforeach
        </div>
    </div>
</x-layout.guest>
