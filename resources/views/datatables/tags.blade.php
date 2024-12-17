@props(['column'])

<div>
    @foreach($column->tags as $tag)
        <span class="badge bg-primary">{{$tag->name}}</span>
    @endforeach
</div>
