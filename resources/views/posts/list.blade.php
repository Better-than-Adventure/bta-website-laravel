<x-app-layout>
    <x-slot:heading>
        <x-page-header title="Blog" image="posts.png"/>
    </x-slot:heading>

    @foreach($posts as $post)
        <x-posts.post-list-item :post="$post"/>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
