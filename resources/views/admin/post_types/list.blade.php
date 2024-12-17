<x-layout.admin>
    <div>
        <h2>Post Types</h2>
        <hr/>
        <a class="btn btn-primary" href="{{route('admin.postTypes.create')}}">Create</a>
        {{ $dataTable->table()  }}
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-layout.admin>

