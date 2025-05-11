<x-layout.admin>
    <div>
        <h2>User Management</h2>
        <hr/>
        <a class="btn btn-primary" href="{{route('admin.users.create')}}">New User</a>
        @if (session('reset-token'))
            <div class="my-3 alert">
                <div>Please reset your password with the following token:</div>
                {{ session('reset-token') }}
            </div>
        @endif
        {{ $dataTable->table() }}
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-layout.admin>
