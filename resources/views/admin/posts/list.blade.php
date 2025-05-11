@props(['type'])

@php
    $title = $type ?? 'page';

@endphp

<x-layout.admin>
    <div>
        <h2>{{Str::plural(Str::title($title))}}</h2>
        <hr/>
        @can('posts.create')
            @if($type != 'homepage')
                <a class="btn btn-primary" href="{{route('admin.posts.create', ['type' => $type ?? null])}}">New {{Str::title($title)}}</a>
           @endif
        @endcan
        {{ $dataTable->table() }}
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-layout.admin>

