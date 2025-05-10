@php(['item'])

<form method="POST" action="{{route('admin.infographics.destroy', compact('item'))}}">
    @csrf
    <button class="text-danger btn btn-link" type="submit">Delete</button>
</form>
