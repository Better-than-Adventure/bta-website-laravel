@php(['item'])
@if(filled($item->image_path))
    <img src="{{asset('images/content/'.$item->post->slug.'/media/'.$item->image_path)}}" style="height: 200px; object-fit:cover;" class="card-img-top" alt="...">
@endif
