
@props(['postType'])

<x-admin-layout>
    <div>
        <h2>Create New Post Type</h2>
        <hr/>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" class="row" action="{{ $postType->exists ? route('admin.postTypes.update', [$postType]) : route('admin.postTypes.store') }}">
            @csrf
            <div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" required name="name" value="{{old('name', $postType->name)}}" placeholder="Name">
                    <label for="floatingInput">Name</label>
                </div>
                @if($postType->exists)
                    <button type="submit" class="btn btn-primary">Edit post type</button>
                @else
                    <button type="submit" class="btn btn-primary">Create post type</button>
                @endif
            </div>
        </form>
    </div>
</x-admin-layout>
