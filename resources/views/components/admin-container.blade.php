@props(['title', 'width' => null])

<div class="admin-container mb-3" @if($width) style="min-width: {{$width}}px" @else style="width: 100%" @endif>
    <div class="head">
        {{$title}}
    </div>
    <div class="content">
        {{ $slot }}
    </div>
</div>
