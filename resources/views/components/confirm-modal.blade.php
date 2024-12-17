@props(['id', 'confirmRoute', 'title', 'description', 'danger', 'class'])

<!-- Button trigger modal -->
<button type="button" class="btn {{$class}}" data-bs-toggle="modal" data-bs-target="#{{$id}}">
    {{$title}}
</button>

<!-- Modal -->
<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{$id}}Label">"{{$title}}"</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$description}}
            </div>
            <div class="modal-footer">
                <a type="button" href="{{route($confirmRoute)}}" class="btn @if($danger) btn-danger @else btn-secondary @endif" data-bs-dismiss="modal">Continue</a>
                <button type="button" class="btn btn-outline-primary">Back</button>
            </div>
        </div>
    </div>
</div>
