@php(['galleryItem'])

<form method="POST" action="{{route('admin.posts.media-delete', ['post' => $galleryItem->post, 'galleryItem' => $galleryItem])}}">
    @csrf
    <button class="text-danger btn btn-link" type="submit">Delete</button>
</form>
