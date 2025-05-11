@php(['galleryItem'])

<a class="me-2 danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-media-{{$galleryItem->id}}').submit();">
    Delete
</a>
<form id="delete-media-{{$galleryItem->id}}" class="d-none" method="POST" action="{{route('admin.posts.media-delete', ['post' => $galleryItem->post, 'galleryItem' => $galleryItem])}}">
    @csrf
</form>
