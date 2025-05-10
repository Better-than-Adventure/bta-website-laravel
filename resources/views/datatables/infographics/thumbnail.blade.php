@php(['item'])
@if(filled($item->image_path))
    <video loading="lazy" width="100%" height="100%" loop="" autoplay="autoplay" class="gallery">
        <source src="{{$item->url}}" type="video/mp4">
    </video>
@endif
