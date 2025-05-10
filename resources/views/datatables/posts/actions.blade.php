@php(['post'])

<div class="d-flex">
    <a class=" btn btn-primary me-1" href="{{route('admin.posts.edit', ['post' => $post])}}" >Edit</a>
    <a class=" btn btn-primary me-1" href="{{route('admin.posts.media', ['post' => $post])}}" >Media</a>
    <form method="POST" action="{{route('admin.posts.destroy', ['post' => $post])}}">
        @csrf
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>
