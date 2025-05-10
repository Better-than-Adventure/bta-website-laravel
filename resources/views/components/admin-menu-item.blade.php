@props([
    'route',
    'label'
])

<div class="admin-nav-item">
    <a href="{{$route}}">
        {{ $label }}
    </a>
</div>
