@php(['post'])

<div class="d-flex">
    @if(auth()->user()->can('posts.edit') || $post->author_id == auth()->user()->id)
        <a class="me-2" href="{{route('admin.posts.edit', ['post' => $post])}}" >Edit</a>
        @if($post->postType->post_template_enum == \App\Enums\EnumPostTemplates::Gallery)
            <a class="me-2" href="{{route('admin.posts.media', ['post' => $post])}}" >Media</a>
        @endif
    @endif
    @if((auth()->user()->can('posts.delete') || $post->author_id == auth()->user()->id) && $post->postType->slug != 'homepage')
        <a class="me-2 danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{$post->id}}').submit();">
            Delete
        </a>
        <form id="delete-form-{{$post->id}}" class="d-none" method="POST" action="{{route('admin.posts.destroy', ['post' => $post])}}">
            @csrf
        </form>
    @endif
</div>
