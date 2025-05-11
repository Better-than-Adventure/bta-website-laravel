@php(['post'])

<div class="d-flex">
    <a class="me-2" href="{{route('admin.posts.edit', ['post' => $post])}}" >Edit</a>
    <a class="me-2" href="{{route('admin.posts.media', ['post' => $post])}}" >Media</a>
    <a class="me-2 danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{$post->id}}').submit();">
        Delete
    </a>
    <form id="delete-form-{{$post->id}}" class="d-none" method="POST" action="{{route('admin.posts.destroy', ['post' => $post])}}">
        @csrf
    </form>
</div>
