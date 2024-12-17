<x-admin-layout>
    <div>
        <h2>Posts</h2>
        <hr/>
        <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Create</a>
        {{ $dataTable->table() }}
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-admin-layout>

