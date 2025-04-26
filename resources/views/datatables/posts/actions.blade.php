@php(['post'])

<a class="text-primary me-1" href="{{route('admin.posts.edit', ['post' => $post])}}" >Edit</a>
<a class="text-primary me-1" href="{{route('admin.posts.media', ['post' => $post])}}" >Media</a>
<a class="text-danger" href="{{route('admin.posts.edit', ['post' => $post])}}">Delete</a>

