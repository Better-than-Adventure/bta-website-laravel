@props(['type'])

@php
    $title = $type ?? 'page';

@endphp

<x-layout.admin>
    <div>
        <h2>{{Str::plural(Str::title($title))}}</h2>
        <hr/>
        <a class="btn btn-primary" href="{{route('admin.posts.create', ['type' => $type ?? null])}}">New {{Str::title($title)}}</a>
        {{ $dataTable->table() }}
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-layout.admin>

