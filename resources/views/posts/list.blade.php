<x-layout.guest>
    <x-slot:heading>
        <x-page-header title="{{$postType->name}}" image="images/header/posts.png"/>
    </x-slot:heading>

    @foreach($posts as $post)
        <x-posts.post-list-item :post="$post"/>
    @endforeach

    {{ $posts->links() }}
</x-layout.guest>
