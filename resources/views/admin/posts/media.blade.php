@props(['post'])

@php

@endphp

<x-layout.admin>
    <div>
        <h2>{{$post->title}} Media</h2>
        <hr/>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data" action="{{route('admin.posts.media-upload', compact('post'))}}">
            @csrf
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input class="form-control" name="description" type="text" id="description">
            </div>
            <div class="mb-3">
                <label for="media" class="form-label">Upload New...</label>
                <input class="form-control" type="file" id="media" required name="media">
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
        {{ $dataTable->table() }}
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-layout.admin>

